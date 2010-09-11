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

#ifndef BASESPRITE_H
#define BASESPRITE_H

#include <SDL/SDL.h>
#include <vector>

#include "../../include/baseerror.h"
#include "../../include/sprite/spriteframe.h"

namespace Sprites
{
    class BaseSprite
    {
        public:
            /**
             * @brief Constructor.
             * @param directory The directory containing the sprite to load.
             * @param debug Whether or not to debug.
             * @param verbose Whether or not to be verbose.
             */
            BaseSprite(const std::string & directory, bool debug = false, bool verbose = false);

            /**
             * @brief Returns whether or not the sprite has already been built.
             * @return True if the sprite is built, false otherwise.
             */
            bool Built() const;

            /**
             * @brief Get the number of frames this sprite has for animation.
             * @return The number of frames in this sprite's current animation.
             */
            int GetNumberOfFrames() const;

            /**
             * @brief Return all of the sprite's frames.
             * @return A pointer to a vector containing the frames of the sprite.
             */
            std::vector<SpriteFrame *> * GetFrames();

            /**
             * @brief Get the height of the sprite.
             */
            int Height() const;

            /**
             * @brief Get the width of the sprite.
             */
            int Width() const;

        private:
            std::string directory;
            std::vector<SpriteFrame *> frames;
            bool built;
            int height;
            int width;

            bool debug;
            bool verbose;
    };

    class BaseSpriteError : public Errors::BaseError
    {
        public: BaseSpriteError(const std::string & msg);
    };
}

#endif // BASESPRITE_H
