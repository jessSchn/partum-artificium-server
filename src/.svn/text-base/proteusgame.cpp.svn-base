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

#include <boost/lambda/lambda.hpp>
#include <boost/lambda/bind.hpp>
#include <algorithm>

#include "proteusgame.h"

#include "../include/sprite/basesprite.h"
#include "../include/output.h"
#include "../include/map/map.h"

void ProteusGame::lock(SDL_Surface * surface)
{
    if (SDL_MUSTLOCK(surface) && SDL_LockSurface(surface) < 0) throw ProteusGameError(SDL_GetError());
}

void ProteusGame::unlock(SDL_Surface * surface)
{
    if (SDL_MUSTLOCK(surface)) SDL_UnlockSurface(surface);
}

ProteusGame::ProteusGame(bool fullscreen, bool debug, bool verbose)
        : screen(NULL), debug(debug), verbose(verbose)
{
    if (SDL_Init(SDL_INIT_EVERYTHING) < 0) throw ProteusGameError(SDL_GetError());

    /**
     * @note I don't think we should start with the screen being so big ...
     * @todo Fix the resolution change when fullscreening.  I like how bioware does this.
     */
    this->screenHeight = (fullscreen) ? SDL_GetVideoInfo()->current_h : 600;
    this->screenWidth = (fullscreen) ? SDL_GetVideoInfo()->current_w : 800;

    this->screenCenter[0] = this->screenWidth / 2;
    this->screenCenter[1] = this->screenHeight / 2;

    unsigned int flags = SDL_HWSURFACE | SDL_DOUBLEBUF | SDL_RESIZABLE;
    if (fullscreen) flags |= SDL_FULLSCREEN;

    this->screen = SDL_SetVideoMode(this->screenWidth, this->screenHeight, 32, flags);
    if (!this->screen) throw ProteusGameError(SDL_GetError());
}

ProteusGame::~ProteusGame()
{
    SDL_Quit();
}

bool ProteusGame::handleEvents()
{
    SDL_Event event;
    /**
     * @todo Change the following to SDL_WaitEvent() and add the rest of the keys to the switch.
     */
    while (SDL_PollEvent(&event))
    {
        switch (event.type)
        {
            case SDL_QUIT:
                return true;
            case SDL_KEYDOWN:
                switch (event.key.keysym.sym)
                {
                    case SDLK_ESCAPE:
                        return true;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
    }
    return false;
}

void ProteusGame::drawScene()
{
    using namespace Sprites;

    this->map->ClearBackground()->UpdateBackground()->Draw();
    for (std::map<std::string, Sprite *>::iterator i = this->sprites.begin(); i != this->sprites.end(); ++i)
        i->second->Draw();

    SDL_Flip(this->screen);
}

void ProteusGame::Run()
{
    using namespace Sprites;
    using namespace Maps;

    Uint8 * keys;

#ifndef IMAGE_PATH
#error Must define IMAGE_PATH to be the absolute path to the images!
#endif

    /**
     * @note Someone set us up the game ...
     */
    try
    {
        this->baseSprites["left"] = new BaseSprite(std::string(IMAGE_PATH) + "/link_walk_left", this->debug);
        this->baseSprites["right"] = new BaseSprite(std::string(IMAGE_PATH) + "/link_walk_right", this->debug);
        this->baseSprites["up"] = new BaseSprite(std::string(IMAGE_PATH) + "/link_walk_up", this->debug);
        this->baseSprites["down"] = new BaseSprite(std::string(IMAGE_PATH) + "/link_walk_down", this->debug);

        this->baseSprites["cockroach"] = new BaseSprite(std::string(IMAGE_PATH) + "/cocroach", this->debug);

        this->map = new Map(new BaseSprite(std::string(IMAGE_PATH) + "/maps/level_01"), this->screen, this->debug);
        this->map->SetPosition(this->screenWidth / 2 - this->map->Width() / 2, this->screenHeight / 2 - this->map->Height() / 2)->SetFrameRate(2);

        /**
         * @todo Put this in another configuration file.
         */
        for (int i = 0; i < 4; ++i)
        {
            Sprite * tmp = new Sprite(this->screen, this->debug);
            tmp->RegisterBase(this->baseSprites["down"], "down")->SetPosition(this->screenWidth / 2 + this->baseSprites["up"]->Height()*i, this->screenHeight / 2 + this->baseSprites["up"]->Height())->SetFrameRate(2);
            /** @note Animation happens by default. */
            this->map->AddSprite(tmp);
        }

        Sprite * tmp = new Sprite(this->screen, this->debug);
        tmp->RegisterBase(this->baseSprites["cockroach"], "cockroach")->SetPosition(this->screenCenter[0] - this->baseSprites["up"]->Width(), this->screenCenter[1] - this->baseSprites["up"]->Height());
        this->map->AddSprite(tmp);

        this->sprites["player"] = new Sprite(this->screen, this->debug);
        this->sprites["player"]
        ->RegisterBase(this->baseSprites["left"], "left")
        ->RegisterBase(this->baseSprites["right"], "right")
        ->RegisterBase(this->baseSprites["up"], "up")
        ->RegisterBase(this->baseSprites["down"], "down");
    }
    catch (BaseSpriteError e)
    {
#ifndef NDEBUG
        DEBUG(std::string(IMAGE_PATH) + "/sitting_troll/");
#endif
        ERROR(e.GetMessage());
    }

    this->sprites["player"]->SetPosition(this->screenWidth / 2, this->screenHeight / 2)->SetFrameRate(2)->StopAnimation();

    SDL_ShowCursor(0);

    this->drawScene();

    do
    {
        if (this->handleEvents()) break;

        keys = SDL_GetKeyState(NULL);

        int movement = 1;

        if (keys[SDLK_UP])
        {
            this->sprites["player"]->ActivateAnimation("up")->NextFrame();
            if (this->map->GetY() < this->sprites["player"]->GetY())
                this->map->IncrementY(movement);
            /** @todo Make this work.  The problem should be in collision now. */
            if (this->map->IsCollission(*this->sprites["player"]))
                this->map->DecrementY(movement);
        }
        else if (keys[SDLK_DOWN])
        {
            this->sprites["player"]->ActivateAnimation("down")->NextFrame();
            if (this->map->GetY() + this->map->Height() > this->sprites["player"]->GetY() + this->sprites["player"]->Height())
                this->map->DecrementY(movement);
        }
        else if (keys[SDLK_LEFT])
        {
            this->sprites["player"]->ActivateAnimation("left")->NextFrame();
            if (this->map->GetX() < this->sprites["player"]->GetX())
                this->map->IncrementX(movement);
        }
        else if (keys[SDLK_RIGHT])
        {
            this->sprites["player"]->ActivateAnimation("right")->NextFrame();
            if (this->map->GetX() + this->map->Width() > this->sprites["player"]->GetX() + this->sprites["player"]->Width())
                this->map->DecrementX(movement);
        }

        this->drawScene();
    }
    while (true);
}

ProteusGameError::ProteusGameError(const std::string &message)
        : BaseError(message)
{
}
