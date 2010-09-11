#include <iostream>
#include <cstdlib>

#include "partumartificium.h"
#include "../include/output.h"

using namespace std;

int main(int argc, char *argv[])
{
    PartumArtificium *application;
    try
    {
        application = new PartumArtificium(argc, argv);
        application->Run();
    }
    catch (PartumArtificiumArgumentError e)
    {
        if (e.GetMessage().length() > 0) ERROR(e.GetMessage());
        cout << e.GetDescription() << endl;
        return EXIT_FAILURE;
    }
    catch (PartumArtficiumError e)
    {
        if (e.GetMessage().length() > 0) ERROR(e.GetMessage());
        return EXIT_FAILURE;
    }
    return EXIT_SUCCESS;
}
