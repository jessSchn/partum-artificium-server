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

#include "../../include/creature/basecreaturetest.h"

CPPUNIT_TEST_SUITE_REGISTRATION(BaseCreatureTest);

void BaseCreatureTest::setUp()
{
    using namespace Creature;

    this->creatureA = new BaseCreature(MAMMAL);
    this->creatureB = new BaseCreature(INSECT);
    this->creatureC = new BaseCreature(REPTILE);
}

void BaseCreatureTest::tearDown()
{
    delete this->creatureA;
    delete this->creatureB;
    delete this->creatureC;
}

void BaseCreatureTest::BaseCreature_Instantiation_PropertiesSet()
{
    using namespace Creature;

    CPPUNIT_ASSERT_EQUAL(this->creatureA->GetCreatureType(), MAMMAL);
    CPPUNIT_ASSERT_EQUAL(this->creatureB->GetCreatureType(), INSECT);
    CPPUNIT_ASSERT_EQUAL(this->creatureC->GetCreatureType(), REPTILE);
}

void BaseCreatureTest::GetModifiers_Instantiation_StatsSet()
{
    using namespace Creature;

    for (std::map<MODIFIERS, float>::iterator i = this->creatureA->GetModifiers()->begin(); i != this->creatureA->GetModifiers()->end(); ++i)
        CPPUNIT_ASSERT_DOUBLES_EQUAL(0.0, i->second, 0.0);
    for (std::map<MODIFIERS, float>::iterator i = this->creatureB->GetModifiers()->begin(); i != this->creatureB->GetModifiers()->end(); ++i)
        CPPUNIT_ASSERT_DOUBLES_EQUAL(0.0, i->second, 0.0);
    for (std::map<MODIFIERS, float>::iterator i = this->creatureC->GetModifiers()->begin(); i != this->creatureC->GetModifiers()->end(); ++i)
        CPPUNIT_ASSERT_DOUBLES_EQUAL(0.0, i->second, 0.0);
}

void BaseCreatureTest::GetBaseDamage_RangeCheck_NumbersInRange()
{
    /**
     * @todo Check the range on the GetBaseDamage() call.
     */
    CPPUNIT_ASSERT_DOUBLES_EQUAL(0.5, this->creatureA->GetBaseDamage(), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(0.5, this->creatureB->GetBaseDamage(), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(0.5, this->creatureC->GetBaseDamage(), 0.5);
}

void BaseCreatureTest::GetBaseDefense_RangeCheck_NumbersInRange()
{
    /**
     * @todo Check the range on the GeetBaseDefense() call.
     */
    CPPUNIT_ASSERT_DOUBLES_EQUAL(0.5, this->creatureA->GetBaseDefense(), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(0.5, this->creatureB->GetBaseDefense(), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(0.5, this->creatureC->GetBaseDefense(), 0.5);
}

void BaseCreatureTest::Damage_ValueCheck_ProperDamage()
{
    /**
     * @todo Make these actually check the boundaries.
     */
    CPPUNIT_ASSERT_DOUBLES_EQUAL(0.5, this->creatureA->Damage(0.0), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(5.5, this->creatureB->Damage(5.0), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(10.5, this->creatureC->Damage(10.0), 0.5);
}

void BaseCreatureTest::GetMaximumHealth_DefaultValue_ProperHealth()
{
    /**
     * @todo Make these actually check the boundaries.
     */
    CPPUNIT_ASSERT_DOUBLES_EQUAL(0.5, this->creatureA->GetMaximumHealth(), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(5.5, this->creatureB->GetMaximumHealth(), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(10.5, this->creatureC->GetMaximumHealth(), 0.5);
}

void BaseCreatureTest::GetCurrentHealth_DefaultValue_ProperHealth()
{
    /**
     * @todo Make these check for a default value.
     * @todo Later add a test that checks taking damage and healing.
     */
    CPPUNIT_ASSERT_DOUBLES_EQUAL(0.5, this->creatureA->GetCurrentHealth(), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(5.5, this->creatureB->GetCurrentHealth(), 0.5);
    CPPUNIT_ASSERT_DOUBLES_EQUAL(10.5, this->creatureC->GetCurrentHealth(), 0.5);
}
