/*
    <one line to give the program's name and a brief idea of what it does.>
    Copyright (C) 2010  Sam Sussman

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

#include "../../include/creature/bodypart.h"
#include "../../include/creature/skill.h"

namespace Creature
{
    BodyPart::BodyPart()
    {
        this->stats[STRENGTH] = 0;
        this->stats[ENDURANCE] = 0;
        this->stats[INTELLIGENCE] = 0;
        this->stats[PERCEPTION] = 0;
        this->stats[AGILITY] = 0;
        this->name = "Empty";
        this->img = "Empty.jpg";
        this->part = HEAD;
        this->type = MAMMAL;
    }

    BodyPart::BodyPart(std::string set_name, std::string set_img, std::map<Creature::STATS, float> stat, PART set_part, PART_TYPE set_type)
    {
        name = set_img;
        img = set_img;
        stats = stat;
        part = set_part;
        type = set_type;
    }
    BodyPart::PART BodyPart::GetPart()
    {
        return part;
    }
    BodyPart::PART_TYPE BodyPart::GetType()
    {
        return type;
    }
    std::map<STATS, float> BodyPart::GetStats()
    {
        return this->stats;
    }
    std::string BodyPart::GetName()
    {
        return name;
    }
    std::string BodyPart::GetImg()
    {
        return img;
    }
    void BodyPart::SetPart(PART set_part)
    {
        part = set_part;
    }
    void BodyPart::SetType(PART_TYPE set_type)
    {
        type = set_type;
    }
    void BodyPart::SetSkill(Skill new_skill)
    {
        this->skills[new_skill.GetName()] = new_skill;
    }

    std::map<std::string, Skill> BodyPart::GetSkills() const
    {
        return this->skills;
    }
}
