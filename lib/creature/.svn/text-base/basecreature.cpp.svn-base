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

#include <cstdio>
#include <cstdlib>

#include "../../include/creature/basecreature.h"
#include "../../include/creature/modifiers.h"

namespace Creature
{
    BaseCreature::BaseCreature(const Creature::TYPES & creature_type)
    {
        this->health = /** @todo Default value? */ 0.0;
        this->creature_type = creature_type;

        this->modifiers[DAMAGE_ADDER] = 0.0;
        this->modifiers[DAMAGE_MULTIPLIER] = 0.0;
        this->modifiers[DEFENSE_ADDER] = 0.0;
        this->modifiers[DEFENSE_MULTIPLIER] = 0.0;

        int seed_value;
        FILE *fd = std::fopen("/dev/urandom", "r");
        std::fread(&seed_value, sizeof(int), 1, fd);

        srandom(seed_value);
    }

    TYPES BaseCreature::GetCreatureType() const
    {
        return creature_type;
    }

    float BaseCreature::GetBaseDamage()
    {
        /** @todo Move the my_random stuff into appropriate parts of this class.
         * Make the seed happen in the constructor and then use the standard random
         * call elsewhere.
         * @todo What's the range on this?
         */
        float damage = (this->stats[STRENGTH] + this->modifiers[DAMAGE_ADDER]) * this->modifiers[DAMAGE_MULTIPLIER] * static_cast<float>(random()) / RAND_MAX;
        return (damage < 0) ? 0 : damage;
    }

    float BaseCreature::GetBaseDefense()
    {
        float defense = ((this->stats[STRENGTH] * 0.25 + this->stats[ENDURANCE] * 0.75 + this->modifiers[DEFENSE_ADDER]) * this->modifiers[DEFENSE_MULTIPLIER] * static_cast<float>(random()) / RAND_MAX) / 10.0;
        return (defense < 0) ? 0 : defense;
    }

    float BaseCreature::Damage(float enemy_damage)
    {
        float damageC = (enemy_damage - this->GetBaseDefense());
        if (damageC < 0)
        {
            return 0;
        }
        else
        {
            health -= damageC;
        }
        if (health < 0)
        {
            health = 0;
        }
        return damageC;
    }

    float BaseCreature::GetMaximumHealth()
    {
        /**
         * @todo This doesn't need to change unless ENDURANCE does.
         */
        this->stats[HEALTH] = stats[ENDURANCE] * 10;
        return this->stats[HEALTH];
    }

    float BaseCreature::GetCurrentHealth() const
    {
        return this->currentHealth;
    }

    std::map<STATS, float> BaseCreature::GetStats() const
    {
        return this->stats;
    }

    void BaseCreature::AddBodyPart(BodyPart part)
    {
        this->bodyParts[part.GetPart()] = new BodyPart(part);
        this->modifyStats(part);  //!< True is implied by this method.
        std::map<std::string, Skill> skills = part.GetSkills();
        for (std::map<std::string, Skill>::iterator i = skills.begin(); i != skills.end(); ++i)
            this->skills[i->first] = i->second;
    }

    void BaseCreature::RemoveBodyPart(BodyPart::PART part)
    {
        this->modifyStats(*this->bodyParts[part], false);
        std::map<std::string, Skill> skills = this->bodyParts[part]->GetSkills();
        for (std::map<std::string, Skill>::iterator i = skills.begin(); i != skills.end(); ++i)
            this->skills.erase(i->first);
        /**
         * If we change the bodyParts map to std::map<std::string, Skill *> we can just delete the parts ...
         */
        delete this->bodyParts[part];
    }

    BodyPart BaseCreature::GetBodyPart(BodyPart::PART part) const
    {
        return *this->bodyParts[part];
    }

    /**
     * @note Denoting ups and downs with a bool doesn't seem quite right.
     */
    void BaseCreature::modifyStats(BodyPart body_part, bool increment)
    {
        /**
         * For each modifier provided by a new body part (item) we increment the stats.
         * We cap the stats at 100 for some reason that Sam should explain here ...
         */
        std::map<STATS, float> stats = body_part.GetStats();
        for (std::map<STATS, float>::iterator i = stats.begin(); i != stats.end(); ++i)
        {
            this->stats[i->first] += (increment) ? i->second : -i->second;
            /**
             * @note Will drop stats permanently if over cap after putting something on
             * and removing it again.
             */
            if (this->stats[i->first] > 100) this->stats[i->first] = 100;
        }
    }

    std::map<std::string, Skill> BaseCreature::GetSkills() const
    {
        return this->skills;
    }


    void BaseCreature::ActivateSkill(std::string skill_name)
    {
        if(skills["skill_name"].IsEnabled())updateModifiers(skills["get_name"].GetModifiers());
    }

    void BaseCreature::DeactivateSkill(std::string skill_name)
    {
        if(skills["skill_name"].IsEnabled())updateModifiers(skills["get_name"].GetModifiers(),false);
    }

    /**
     * @note Should this be available to others?
     */
    std::map<MODIFIERS, float> * BaseCreature::GetModifiers()
    {
        return &this->modifiers;
    }

    void BaseCreature::updateModifiers(std::map<MODIFIERS, float> mods, bool increment)
    {
        /** @note Pass a modifier and it adds it to the current modifiers */
        for (std::map<MODIFIERS, float>::iterator i = mods.begin(); i != mods.end(); ++i)
        {
            this->modifiers[i->first] += (increment) ? i->second : -i->second;
		}
	}

    void BaseCreature::updateStats(std::map<STATS, float>, bool)
    {
    }
}
