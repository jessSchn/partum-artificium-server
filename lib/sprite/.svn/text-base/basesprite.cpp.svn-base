/*
    A BaseSprite to hold the animation details of a Sprite.
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

#include <sstream>

#include "../../include/sprite/basesprite.h"

#include "../../include/output.h"
#include "../../include/yaml/yamlspriteparser.h"

namespace Sprites
{
    BaseSprite::BaseSprite(const std::string & directory, bool debug, bool verbose)
    : directory(directory), built(false), height(0), width(0), debug(debug), verbose(verbose)
    {
        Yaml::YamlSpriteParser parser(this->directory, this->debug, this->verbose);
        try
        {
            this->frames = parser.Parse();
        }
        catch (Yaml::YamlSpriteParserError e)
        {
            WARNING(this->directory + " not able to be parsed!");
            ERROR(e.GetMessage());
        }
        this->built = true;

        for (std::vector<SpriteFrame *>::iterator i = this->frames.begin(); i != this->frames.end(); ++i)
        {
            if (this->height < (*i)->GetImage()->h) this->height = (*i)->GetImage()->h;
            if (this->width < (*i)->GetImage()->w) this->width = (*i)->GetImage()->w;
        }
    }

    bool BaseSprite::Built() const
    {
        return this->built;
    }

    int BaseSprite::GetNumberOfFrames() const
    {
        return this->frames.size();
    }

    std::vector<SpriteFrame *> * BaseSprite::GetFrames()
    {
        return &this->frames;
    }

    int BaseSprite::Height() const
    {
        return this->height;
    }

    int BaseSprite::Width() const
    {
        return this->width;
    }

    BaseSpriteError::BaseSpriteError(const std::string & msg)
            : BaseError(msg)
    {
    }
}
