/*
    Definition for a test case for a BaseCreature.
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

#ifndef BASECREATURETEST_H
#define BASECREATURETEST_H

#include "../../../../include/creature/basecreature.h"

#include <cppunit/TestFixture.h>
#include <cppunit/extensions/HelperMacros.h>
#include <cppunit/TestAssert.h>

class BaseCreatureTest : public CppUnit::TestFixture
{
    CPPUNIT_TEST_SUITE(BaseCreatureTest);
    /**
     * @note To add tests to the suite do the following:
     CPPUNIT_ASSERT(condition) - Assertions that a condition is true.
     CPPUNIT_ASSERT_MESSAGE(message, condition) - Assertion with a user specified message.
     CPPUNIT_FAIL(message) - Fails with the specified message.
     CPPUNIT_ASSERT_EQUAL(expected, actual) - Asserts that two values are equals.
     CPPUNIT_ASSERT_EQUAL_MESSAGE(message, expected, actual) - Asserts that two values are equals, provides additional messafe on failure.
     CPPUNIT_ASSERT_DOUBLES_EQUAL(expected, actual, delta) - Macro for primitive value comparisons.
     CPPUNIT_ASSERT_THROW(expression, ExceptionType) - Asserts that the given expression throws an exception of the specified type.
     CPPUNIT_ASSERT_NO_THROW(expression) - Asserts that the given expression does not throw any exceptions.
     CPPUNIT_ASSERT_ASSERTION_FAIL(assertion) - Asserts that an assertion fail.
     CPPUNIT_ASSERT_ASSERTION_PASS(assertion) - Asserts that an assertion pass.
     */
    CPPUNIT_TEST(BaseCreature_Instantiation_PropertiesSet); //!< @todo Needs to be implemented?
    CPPUNIT_TEST(GetModifiers_Instantiation_StatsSet);
    CPPUNIT_TEST(GetBaseDamage_RangeCheck_NumbersInRange);
    CPPUNIT_TEST(GetBaseDefense_RangeCheck_NumbersInRange);
    CPPUNIT_TEST(Damage_ValueCheck_ProperDamage);
    CPPUNIT_TEST(GetMaximumHealth_DefaultValue_ProperHealth);
    CPPUNIT_TEST(GetCurrentHealth_DefaultValue_ProperHealth);
    CPPUNIT_TEST_SUITE_END();

    public:
        /**
         * @brief Initialize the testing environment.
         */
        void setUp();

        /**
         * @brief Tear down the testing environment.
         */
        void tearDown();

    protected:
        /**
         * @note Test methods go here.
         */
        void BaseCreature_Instantiation_PropertiesSet();
        void GetModifiers_Instantiation_StatsSet();
        void GetBaseDamage_RangeCheck_NumbersInRange();
        void GetBaseDefense_RangeCheck_NumbersInRange();
        void Damage_ValueCheck_ProperDamage();
        void GetMaximumHealth_DefaultValue_ProperHealth();
        void GetCurrentHealth_DefaultValue_ProperHealth();

    private:
        Creature::BaseCreature * creatureA;
        Creature::BaseCreature * creatureB;
        Creature::BaseCreature * creatureC;
};

#endif // BASECREATURETEST_H
