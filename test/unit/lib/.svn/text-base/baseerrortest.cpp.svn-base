/*
    Definition for a test case for a BaseError.
    Copyright (C) 2010 Alex Brandt

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

*/

#include "../include/baseerrortest.h"

CPPUNIT_TEST_SUITE_REGISTRATION(BaseErrorTest);

void BaseErrorTest::setUp()
{
    using namespace Errors;

    this->errorA = new BaseError("Testing!");
}

void BaseErrorTest::tearDown()
{
    delete this->errorA;
}

void BaseErrorTest::BaseError_Instantiation_PropertiesSet()
{
    CPPUNIT_ASSERT(this->errorA->GetMessage() == "Testing!");
}
