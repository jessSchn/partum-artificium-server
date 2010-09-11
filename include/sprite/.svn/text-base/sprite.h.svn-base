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

#ifndef SPRITE_H
#define SPRITE_H

#include <map>

#include "../../include/sprite/basesprite.h"

namespace Sprites
{
    class Sprite
    {
        public:
            /**
             * @brief Constructor.
             * @param screen The screen to draw this sprite to.
             * @param debug Turn on debugging.
             * @param verbose Wether or not to be verbose.
             */
            Sprite(SDL_Surface * screen, bool debug = false, bool verbose = false);

            /**
             * @brief Register a base with this Sprite.
             * @param baseSprite The base sprite holding our animation information.
             * @param name The name of the base for animation.
             */
            Sprite * RegisterBase(BaseSprite * baseSprite, const std::string & name);

            /**
             * @brief Draw the sprite to the screen that it is associated with.
             */
            Sprite * Draw();

            /**
             * @brief Clear the background of this sprite to blank.
             */
            Sprite * ClearBackground();

            /**
             * @brief Update the background of this sprite.
             */
            Sprite * UpdateBackground();

            /**
             * @brief Set the current frame to animate next.
             */
            Sprite * SetFrame(int number);

            /**
             * @brief Get the current frame.
             */
            int GetFrame();

            /**
             * @brief Set the framerate for animation.
             * @param frameRate The frame rate to animate the sprite at.
             * @note The frame rate is in frames per second.
             */
            Sprite * SetFrameRate(float frameRate);

            float GetFrameRate() const;

            Sprite * ToggleAnimation();
            Sprite * StartAnimation();
            Sprite * StopAnimation();

            /**
             * @brief Rewind so the next frame to be drawn is the first frame in the sequence.
             */
            Sprite * Rewind();

            /**
             * @brief Decrement the Y position of the sprite.
             * @param decrement The number of pixels to decrement by.
             */
            Sprite * DecrementY(int decrement = 1);

            /**
             * @brief Increment the Y position of the sprite.
             * @param increment The number of pixels to increment by.
             */
            Sprite * IncrementY(int increment = 1);

            /**
             * @brief Decrement the X position of the sprite.
             * @param decrement The number of pixels to decrement by.
             */
            Sprite * DecrementX(int decrement = 1);

            /**
             * @brief Increment the X position of the sprite.
             * @param increment The number of pixels to increment by.
             */
            Sprite * IncrementX(int increment = 1);

            /**
             * @brief Get the Y position of the Sprite.
             * @return The Y position of the Sprite.
             */
            int GetY() const;

            /**
             * @brief Get the X posiition of the Sprite.
             * @return The X position of the Sprite.
             */
            int GetX() const;

            /**
             * @brief Get the height of the sprite in pixels.
             * @return The Sprite's height in pixels.
             */
            int Height() const;

            /**
             * @brief Get the width of the sprite in pixels.
             * @return The Sprite's width in pixels.
             */
            int Width() const;

            /**
             * @brief Set the sprite's position.
             * @param x The x position.
             * @param y The y position.
             */
            Sprite * SetPosition(int x, int y);

            /**
             * @brief Activate a particular animation.
             * @param name The name of the animation to activate.
             */
            Sprite * ActivateAnimation(const std::string & name);

            /**
             * @brief Go to the next frame in the animation.
             */
            Sprite * NextFrame();

        protected:
            bool debug;
            bool verbose;

        private:
            int height;
            int width;

            std::string active;

            std::vector<SpriteFrame *>::iterator frame;
            int x, y, previous_x, previous_y;

            bool animating;
            bool drawn;
            bool positioned;

            float frameRate;
            long lastUpdate;
            std::map<std::string, BaseSprite *> baseSprites;
            SDL_Surface * background;
            SDL_Surface * screen;
    };
}

#endif // SPRITE_H
