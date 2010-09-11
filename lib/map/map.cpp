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

#include "../../include/map/map.h"

#include "../../include/output.h"

#include <algorithm>
#include <boost/lambda/bind.hpp>
#include <boost/lambda/lambda.hpp>
#include <boost/lexical_cast.hpp>

namespace Maps
{
    Map::Map(Sprites::BaseSprite * base, SDL_Surface * screen, bool debug, bool verbose)
            : Sprite(screen, debug)
    {
        this->RegisterBase(base, "map");
    }

    bool Map::IsCollission(const Sprites::Sprite & sprite)
    {
        VERBOSE("Calling Collision Handler!");
        /**
         * @note This is highly inefficient, but will give a working implementation while we work.
         */
        for (std::list<Sprites::Sprite *>::iterator i = this->actors.begin(); i != this->actors.end(); ++i)
        {
            if (((*i)->GetX() < sprite.GetX() && sprite.GetX() < (*i)->GetX() + (*i)->Width())
                || ((*i)->GetX() < sprite.GetX() + sprite.Width() && sprite.GetX() + sprite.Width() < (*i)->GetX() + (*i)->Width())
                || ((*i)->GetY() < sprite.GetY() && sprite.GetY() < (*i)->GetY() + (*i)->Height())
                || ((*i)->GetY() < sprite.GetY() + sprite.Height() && sprite.GetY() + sprite.Height() < (*i)->GetY() + (*i)->Height()))
                {
                    #ifndef NDEBUG
                        std::string output;
                        output += "Collision with (";
                        output += boost::lexical_cast<std::string>((*i)->GetX());
                        output += ", ";
                        output += boost::lexical_cast<std::string>((*i)->GetY());
                        output += ")";
                        VERBOSE(output);
                    #endif
                    return true;
                }
        }
        return false;
    }

    Map * Map::AddSprite(Sprites::Sprite * sprite)
    {
        this->actors.push_back(sprite);
        return this;
    }

    Map * Map::Draw()
    {
        using namespace boost::lambda;

        VERBOSE("Calling Map's Draw!");
        Sprites::Sprite::Draw();
        this->actors.front()->Draw();
        std::for_each(this->actors.begin(), this->actors.end(), bind(&Sprites::Sprite::Draw, _1));
        return this;
    }

    Map * Map::IncrementX(int increment)
    {
        using namespace boost::lambda;

        Sprites::Sprite::IncrementX(increment);
        std::for_each(this->actors.begin(), this->actors.end(), bind(&Sprites::Sprite::IncrementX, _1, increment));
        return this;
    }

    Map * Map::DecrementX(int decrement)
    {
        this->IncrementX(-decrement);
        return this;
    }

    Map * Map::IncrementY(int increment)
    {
        using namespace boost::lambda;

        Sprites::Sprite::IncrementY(increment);
        std::for_each(this->actors.begin(), this->actors.end(), bind(&Sprites::Sprite::IncrementY, _1, increment));
        return this;
    }

    Map * Map::DecrementY(int decrement)
    {
        this->IncrementY(-decrement);
        return this;
    }

    Map * Map::UpdateBackground()
    {
        Sprites::Sprite::UpdateBackground();
        return this;
    }

    Map * Map::ClearBackground()
    {
        Sprites::Sprite::ClearBackground();
        return this;
    }
}
