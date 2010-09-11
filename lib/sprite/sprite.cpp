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

#include "../../include/sprite/sprite.h"
#include "../../include/output.h"

#include <cassert>

namespace Sprites
{
    int Sprite::GetY() const
    {
        return this->y;
    }

    int Sprite::GetX() const
    {
        return this->x;
    }

    Sprite * Sprite::IncrementY(int increment)
    {
        this->previous_y = this->y;
        this->previous_x = this->x;
        this->y += increment;
        return this;
    }

    Sprite * Sprite::DecrementY(int decrement)
    {
        this->IncrementY(-decrement);
        return this;
    }

    Sprite * Sprite::DecrementX(int decrement)
    {
        this->IncrementX(-decrement);
        return this;
    }

    Sprite * Sprite::IncrementX(int increment)
    {
        this->previous_x = this->x;
        this->previous_y = this->y;
        this->x += increment;
        return this;
    }

    int Sprite::Width() const
    {
        return this->width;
    }

    int Sprite::Height() const
    {
        return this->height;
    }

    Sprite * Sprite::SetFrame(int number)
    {
        /**
         * HACK
         * @note There must be a better way to do this.
         */
        std::vector<SpriteFrame *>::iterator i = this->baseSprites[this->active]->GetFrames()->begin();
        for (int count = 0; count < number && i != this->baseSprites[this->active]->GetFrames()->end(); ++i, ++count);
        this->frame = i;
        return this;
    }

    int Sprite::GetFrame()
    {
        /**
         * HACK
         * @note There must be a better way to this.
         */
        std::vector<SpriteFrame *>::iterator i = this->baseSprites[this->active]->GetFrames()->begin();
        int count = 0;
        for (; i != this->frame && i != this->baseSprites[this->active]->GetFrames()->end(); ++count, ++i);
        return count;
    }

    Sprite * Sprite::SetFrameRate(float frameRate)
    {
        this->frameRate = frameRate;
        return this;
    }

    float Sprite::GetFrameRate() const
    {
        return this->frameRate;
    }

    Sprite * Sprite::ToggleAnimation()
    {
        this->animating = !this->animating;
        return this;
    }

    Sprite * Sprite::StartAnimation()
    {
        this->animating = true;
        return this;
    }

    Sprite * Sprite::StopAnimation()
    {
        this->animating = false;
        return this;
    }

    Sprite * Sprite::Rewind()
    {
        this->frame = this->baseSprites[this->active]->GetFrames()->begin();
        return this;
    }

    Sprite * Sprite::NextFrame()
    {
        if (++this->frame == this->baseSprites[this->active]->GetFrames()->end())
            this->Rewind();
        return this;
    }

    Sprite * Sprite::SetPosition(int x, int y)
    {
        if (this->positioned)
        {
            this->previous_x = this->x;
            this->previous_y = this->y;
        }
        else
        {
            this->positioned = true;
            this->previous_x = x;
            this->previous_y = y;
        }

        this->x = x;
        this->y = y;
        return this;
    }

    Sprite::Sprite(SDL_Surface * screen, bool debug, bool verbose)
            : screen(screen), debug(debug), verbose(verbose), x(0), y(0), drawn(false), positioned(false), lastUpdate(0), height(0), width(0)
    {
        this->background = SDL_DisplayFormat(this->screen);
    }

    Sprite * Sprite::RegisterBase(BaseSprite * base, const std::string & name)
    {
        this->active = name;
        this->baseSprites[name] = base;
        if (this->baseSprites[this->active]->Built())
        {
            if (this->baseSprites[this->active]->GetNumberOfFrames() > 1) this->animating = true;

            if (this->baseSprites[this->active]->Height() > this->height)
                this->height = this->baseSprites[this->active]->Height();
            if (this->baseSprites[this->active]->Width() > this->width)
                this->width = this->baseSprites[this->active]->Width();

            this->Rewind();
        }
        return this;
    }

    Sprite * Sprite::ClearBackground()
    {
        if (this->drawn)
        {
            /**
             * HACK
             * @todo Fix this uber hack.
             */
            SDL_Rect destination;
            destination.x = this->previous_x - 1;
            destination.y = this->previous_y - 1;
            destination.w = this->Width() + 2;
            destination.h = this->Height() + 2;
            SDL_BlitSurface(this->background, &destination, this->screen, &destination);
        }
        return this;
    }

    Sprite * Sprite::UpdateBackground()
    {
        /**
         * HACK
         * @todo Fix this uber hack.
         */
        SDL_Rect source;
        source.w = this->Width() + 2;
        source.h = this->Height() + 2;
        source.x = this->x - 1;
        source.y = this->y - 1;
        SDL_BlitSurface(this->screen, &source, this->background, &source);
        return this;
    }

    Sprite * Sprite::Draw()
    {
        if (this->animating)
        {
            /**
             * @note Ticks are not seconds.
             * @note According to the documentation this is milliseconds, but I wonder
             *   what happens on a dynamic tick system.
             */
            if (this->lastUpdate + ((*this->frame)->GetPause() / this->frameRate)*1000 < SDL_GetTicks())
            {
                if (++this->frame == this->baseSprites[this->active]->GetFrames()->end()) this->Rewind();
                this->lastUpdate = SDL_GetTicks();
            }
        }
        if (!this->drawn) this->drawn = true;

        SDL_Rect destination;
        destination.x = this->x;
        destination.y = this->y;

        SDL_BlitSurface((*this->frame)->GetImage(), NULL, this->screen, &destination);
        return this;
    }

    Sprite * Sprite::ActivateAnimation(const std::string & name)
    {
        if (this->active == name) return this;
        this->active = name;
        this->Rewind();
        return this;
    }
}
