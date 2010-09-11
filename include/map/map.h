/*
    <one line to give the program's name and a brief idea of what it does.>
    Copyright (C) <year>  <name of author>

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

#ifndef MAP_H
#define MAP_H

#include <SDL/SDL.h>
#include <list>

#include "../../include/sprite/sprite.h"

namespace Maps
{
    class Map : public Sprites::Sprite
    {
        public:
            /**
             * @brief Constructor.
             * @param base The base animations.
             * @param screen The screen to draw on.
             * @param debug Whether or not to debug.
             * @param verbose Whether or not to be verbose.
             */
            Map(Sprites::BaseSprite * base, SDL_Surface * screen, bool debug = false, bool verbose = false);

            /**
             * @note Overloads from Sprite
             */
            Map * Draw();
            Map * IncrementX(int increment = 1);
            Map * DecrementX(int decrement = 1);
            Map * IncrementY(int increment = 1);
            Map * DecrementY(int decrement = 1);
            Map * ClearBackground();
            Map * UpdateBackground();

            /**
             * @brief Add a sprite to the map.
             * @param sprite The sprite to add.
             * @todo This should be made private after a config file is created.
             */
            Map * AddSprite(Sprites::Sprite * sprite);

            /**
             * @brief Determine if the passed sprite collides with one of the map's sprites.
             * @param sprite
             * @return True if there is a collision.
             */
            bool IsCollission(const Sprites::Sprite & sprite);

        private:
            std::list<Sprites::Sprite *> actors;
	  };
}

#endif // MAP_H
