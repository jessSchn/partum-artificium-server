/*
    <one line to give the program's name and a brief idea of what it does.>
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

#ifndef PROTEUSGAME_H
#define PROTEUSGAME_H

#include <SDL/SDL.h>
#include <map>

#include "../include/baseerror.h"
#include "../include/sprite/basesprite.h"
#include "../include/sprite/sprite.h"
#include "../include/map/map.h"


class ProteusGame
{
    public:
        /**
         * @brief Constructor.
         */
        ProteusGame(bool fullscreen, bool debug = false, bool verbose = false);

        /**
         * @brief Destructor.
         */
        ~ProteusGame();

        /**
         * @brief Run the game.
         */
        void Run();

    private:
        /**
         * @brief Lock the SDL_Surface passed.
         * @param surface The surface to lock.
         */
        void lock(SDL_Surface * surface);

        /**
         * @brief Unlock the SDL_Surface passed.
         * @param surface The surface to unlock.
         */
        void unlock(SDL_Surface * surface);

        /**
         * @brief Draw the scene to the screen.
         */
        void drawScene();

        /**
         * @brief Handle the events and return whether to end or not.
         * @todo Make this much much much better.
         */
        bool handleEvents();


        SDL_Surface * screen;
        int screenHeight;
        int screenWidth;
        int screenCenter[2];
        std::map<std::string, Sprites::BaseSprite * > baseSprites;
        std::map<std::string, Sprites::Sprite * > sprites;

        bool debug;
        bool verbose;

        Maps::Map * map;
};

class ProteusGameError : public Errors::BaseError
{
    public:
        ProteusGameError(const std::string & msg);
};

#endif // PROTEUSGAME_H
