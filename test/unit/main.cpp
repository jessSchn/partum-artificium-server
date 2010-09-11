#include <cppunit/extensions/TestFactoryRegistry.h>
#include <cppunit/ui/text/TestRunner.h>
#include <cppunit/CompilerOutputter.h>

#include <boost/filesystem.hpp>

#include <iostream>
#include <dlfcn.h>

#include "../../include/output.h"

using namespace boost::filesystem;

void load_testing_libraries(const std::string & root_path)
{
    directory_iterator end;
    for (directory_iterator i(root_path); i != end; ++i)
    {
        if (is_directory(*i) && i->leaf().at(0) != '.') load_testing_libraries(i->string());
        else if (extension(*i) == ".so" && !dlopen(i->string().c_str(), RTLD_NOW | RTLD_GLOBAL))
            ERROR(dlerror());
    }
}

int main(int argc, char *argv[])
{
#ifndef TEST_PATH
#error TEST_PATH needs to be defined to load the testing libraries.
#endif
    std::string root_path(TEST_PATH);

    load_testing_libraries(root_path);

    CppUnit::TextUi::TestRunner runner;

    runner.addTest(CppUnit::TestFactoryRegistry::getRegistry().makeTest());

    if (argc > 0) runner.setOutputter(new CppUnit::CompilerOutputter(&runner.result(), std::cerr));

    return runner.run("", false) ? 0 : 1;
}
