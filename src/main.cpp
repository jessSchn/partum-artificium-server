#include <iostream>
#include <cstdlib>

#include "proteus.h"
#include "../include/output.h"

using namespace std;

int main(int argc, char *argv[])
{
    Proteus *application;
    try
    {
        application = new Proteus(argc, argv);
        application->Run();
    }
    catch (ProteusArgumentError e)
    {
        if (e.GetMessage().length() > 0) ERROR(e.GetMessage());
        cout << e.GetDescription() << endl;
        return EXIT_FAILURE;
    }
    catch (ProteusError e)
    {
        if (e.GetMessage().length() > 0) ERROR(e.GetMessage());
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}
