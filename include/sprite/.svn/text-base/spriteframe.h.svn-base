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

#ifndef SPRITEFRAME_H
#define SPRITEFRAME_H

#include <SDL/SDL.h>

namespace Sprites
{
    class SpriteFrame
    {
        public:
            /**
             * @brief Constructor.
             * @param image The surface to store.
             * @param pause The length to pause on this frame.
             * @note pause is measured in frames.
             */
            SpriteFrame(SDL_Surface * image, int pause);

            /**
             * @brief Get the image stored in this frame.
             * @return The SDL_Surface pointer for this image.
             */
            SDL_Surface * GetImage() const;

            /**
             * @brief Get the pause length of this frame.
             * @return This frames pause value.
             * @note The pause value is the number of frames to hold this image->
             */
            int GetPause() const;

        private:
            SDL_Surface * image;
            int pause;
    };
}

#endif // SPRITEFRAME_H
