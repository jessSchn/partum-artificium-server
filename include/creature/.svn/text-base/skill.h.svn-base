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

#ifndef SKILL_H
#define SKILL_H

#include <string>
#include <map>

#include "../../include/creature/modifiers.h"
#include "../../include/creature/stats.h"

namespace Creature
{
    class Skill
    {
        public:
            Skill();
            Skill(std::string);
            Skill(std::map<Creature::STATS, float> stats, std::map<Creature::MODIFIERS, float> mods, std::string);

            /**
             * @brief Enable the skill for use by a creature.
             * @note This should probably be in the BaseCreature class for proper decoupling.
			 * @see ToggleEnabled.
             */
            bool IsEnabled();

			/**
			 * @note toggle the enabled bool. Default 1.
			 * Enabled means the creature can use this skill with its current stats.
			 */
			void ToggleEnabled(bool toggle= 1);

            /**
             * @brief Get the modifiers this skill provides.
             * @note Should skills have modifiers, I think yes.
             */
            std::map<MODIFIERS, float> GetModifiers() const;

            /**
             * @brief Get the stats this skill provides.
             * @note Should skills have stats, I think yes.
             */
            std::map<STATS, float> GetStats() const;

            bool Check(std::map<Creature::STATS, float> stats);
            std::string GetName();
            void SetStats(float str, float intel, float agi, float end, float per);
            void SetMods(float dam_add, float dam_multi, float def_add, float def_multi);


        private:
            std::map<Creature::STATS, float> req; //!< @note What is this?
            std::map<Creature::MODIFIERS, float> mods; //!< @note What is this?
            std::string name;
			bool enabled;
    };
}

#endif
