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

#ifndef BODYPART_H
#define BODYPART_H

#include <string>
#include <map>

#include "../../include/creature/skill.h"

namespace Creature
{
    class BodyPart
    {
        public:
            enum PART { HEAD, BODY, LEGS, FEET, TAIL };
            enum PART_TYPE { INSECT, REPTILE, MAMMAL };
            BodyPart();
            BodyPart(std::string, std::string img, std::map<Creature::STATS, float> stat, PART part, PART_TYPE part_type);
            PART GetPart();
            PART_TYPE GetType();
            std::map<STATS, float> GetStats();
            std::string GetName();
            std::string GetImg();
            void SetPart(PART);
            void SetType(PART_TYPE);
            void SetSkill(Skill);
            void CheckSkill(std::string skill_names[], int &total_skills, std::map<std::string, float> creature_stat);
            std::map<std::string, Skill> GetSkills() const;

        private:
            std::map<STATS, float> stats;
            std::string img,
            name;
            PART part;
            PART_TYPE type;
            std::map<std::string, Skill> skills;
    };
}

#endif
