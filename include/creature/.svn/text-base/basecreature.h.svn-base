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

#ifndef BASECREATURE_H
#define BASECREATURE_H

#include <string>
#include <map>
#include <vector>

#include "../../include/creature/stats.h"
#include "../../include/creature/bodypart.h"
#include "../../include/creature/modifiers.h"
#include "../../include/creature/types.h"

namespace Creature
{
    class BaseCreature
    {
        public:
            /**
             * @brief Constructor
             * @param creature_type The name of something ...
             * @todo Change name to type and an enum?
             */
            explicit BaseCreature(const TYPES & creature_type);

            /**
             * @brief Returns the stats of the BaseCreature.
             * @return The statistics for this BaseCreature.
             *
             * Stats: Strength, Endurance, Perception, Agility, Intelligence.
             */
            std::map<STATS, float> GetStats() const;

            /**
             * @brief Get the type of creature that we have.
             * @return The type of creature.
             * @todo Should the type of creature be an enum?
             */
            TYPES GetCreatureType() const;

            /**
             * @brief Get the base damage of this BaseCreature.
             * @return A float of the base damage.
             */
            float GetBaseDamage();

            /**
             * @brief Get the base defense value of this BaseCreature.
             * @return A float of the base defense.
             */
            float GetBaseDefense();

            /**
             * @brief Get the current health of the BaseCreature.
             * @return A float of the current health.
             */
            float GetCurrentHealth() const;

            /**
             * @brief Get the maximum health of the BaseCreature.
             * @return A float of the maximum health.
             */
            float GetMaximumHealth();

            /**
             * @brief Get the BodyPart specified for a BaseCreature.
             * @param part The part to return?
             * @return The BodyPart we passed in?
             */
            BodyPart GetBodyPart(BodyPart::PART part) const;

            /**
             * @brief Get the modifiers from something.
             * @return A map that maps the modifier name to its value.
             * @todo Remove this?
             */
            std::map<MODIFIERS, float> * GetModifiers();

            /**
             * @brief Get the names of the skills ...
             * @return A map of names of skills mapped to skills.
             */
            std::map < std::string, Skill > GetSkills() const;

            /**
             * @brief Recieve damage.
             * @param enemy_damage The damage to take?
             * @return Some float?
             */
            float Damage(float enemy_damage);

            /**
             * @brief Add a body part to the BaseCreature.
             * @param part The part to add.
             */
            void AddBodyPart(BodyPart part);

            /**
             * @brief Remove the body part specified.
             * @param part The part to remove.
             * @note Why is the following parameter different than the above?
             */
            void RemoveBodyPart(BodyPart::PART part);

            /**
             * @brief Activate the skill for something.
             * @param NAME_ME The skill to activate.
             */
            void ActivateSkill(std::string NAME_ME);

            /**
             * @brief Deactivate the skill.
             * @param NAME_ME The skill to deactivate.
             */
            void DeactivateSkill(std::string NAME_ME);

        private:
            /**
             * @brief Update the modifiers of the creature based on the thing passed.
             * @param modifiers The list of modifiers to parse for modifications.
             * @param increment To increment or decrement.
             */
            void updateModifiers(std::map<MODIFIERS, float> modifiers, bool increment = true);

            /**
             * @brief Update the stats of the creature based on the thing passed.
             * @param stats The list of stats to parse for modifications.
             * @param increment To increment or decrement.
             */
            void updateStats(std::map<STATS, float> stats, bool increment = true);

            TYPES creature_type;
            std::map < std::string, Skill> skills;
            void modifyStats(BodyPart, bool increment = true);
            float health;
            float currentHealth;
            std::map<MODIFIERS, float> modifiers;
            std::map<STATS, float> stats;
            std::vector<BodyPart *> bodyParts; //!< @note Make this a much better name!
    };
}

#endif

