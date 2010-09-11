/*
    <One line description of this file.>
    Copyright (C) 2010 Sam Sussman

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

#include <string>

#include "../../include/creature/skill.h"

namespace Creature
{
    Skill::Skill()
    {
        SetStats(0, 0, 0, 0, 0);
        SetMods(0, 0, 0, 0);
        name = "Empty Skill";
    }

    Skill::Skill(std::string n_name)
    {
        SetStats(0, 0, 0, 0, 0);
        SetMods(0, 0, 0, 0);
        name = n_name;
    }

    Skill::Skill(std::map<Creature::STATS, float> stat, std::map<Creature::MODIFIERS, float> ams, std::string n_name)
    {
        req = stat;
        mods = ams;
        name = n_name;
    }

    bool Skill::Check(std::map<Creature::STATS, float> stat)
    {
        if (req[STRENGTH] < stat[STRENGTH]
	  && req[ENDURANCE]< stat[ENDURANCE]
	  && req[AGILITY] < stat[AGILITY]
	  && req[INTELLIGENCE] < stat[INTELLIGENCE]
	  && req[PERCEPTION] < stat[PERCEPTION])
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    std::string Skill::GetName()
    {
        return name;
    }

    std::map<Creature::MODIFIERS, float> Skill::GetModifiers() const
    {
        return mods;
    }

    void Skill::SetStats(float str, float intel, float agi, float end, float per)
    {
        req[STRENGTH] = str;
        req[INTELLIGENCE] = intel;
        req[AGILITY] = agi;
        req[ENDURANCE] = end;
        req[PERCEPTION] = per;
    }

    void Skill::SetMods(float damAdd, float damMulti, float defAdd, float defMulti)
    {
        mods[DAMAGE_ADDER] = damAdd;
        mods[DAMAGE_MULTIPLIER] = damMulti;
        mods[DEFENSE_ADDER] = defAdd;
        mods[DEFENSE_MULTIPLIER] = defMulti;
    }

    void Skill::ToggleEnabled(bool toggle)
    {
	  enabled=toggle;
    }

    bool Skill::IsEnabled()
    {
	  return enabled;
    }

    std::map<Creature::STATS, float> Skill::GetStats() const
    {
	  return req;
    }
}
