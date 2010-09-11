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

#include "../../include/yaml/yamlspriteparser.h"

#include "../../include/output.h"

#include <yaml.h>
#include <sstream>
#include <stack>
#include <boost/lexical_cast.hpp>

namespace Yaml
{
    YamlSpriteParser::YamlSpriteParser(const std::string & directory, bool debug, bool verbose)
            : directory(directory), debug(debug), verbose(verbose)
    {
        std::stringstream configuration_file;
        configuration_file << this->directory << "/config.yml";

#ifndef NDEBUG
        DEBUG(configuration_file.str());
#endif

        yaml_parser_initialize(&this->parser);

        if ((this->config_fd = std::fopen(configuration_file.str().c_str(), "r")) == NULL)
        {
            ERROR("Could not open configuration file: " + configuration_file.str());
            throw YamlSpriteParserError("Could not open YAML file!");
        }
        yaml_parser_set_input_file(&this->parser, this->config_fd);
    }

    YamlSpriteParser::~YamlSpriteParser()
    {
        yaml_parser_delete(&this->parser);
        yaml_document_delete(&this->document);
        std::fclose(this->config_fd);
    }

    std::vector<Sprites::SpriteFrame *> YamlSpriteParser::Parse()
    {
        using namespace boost;

        if (!yaml_parser_load(&this->parser, &this->document))
            throw YamlSpriteParserError("Yaml Parsing Error!");
        yaml_node_t * root_node = yaml_document_get_root_node(&this->document);

        /**
         * @note This is absolutely crazy.  Don't pull your hair out changing it unless you're
         * completely nuts.
         */
        if (root_node->type != YAML_MAPPING_NODE) throw YamlSpriteParserError("Improperly formatted configuration file!");
        for (yaml_node_pair_t * i = root_node->data.mapping.pairs.start; i < root_node->data.mapping.pairs.top; ++i)
        {
            yaml_node_t * current = yaml_document_get_node(&this->document, i->value);
            if (current->type != YAML_MAPPING_NODE) throw YamlSpriteParserError("Improperly formatted configuration file!");
            for (yaml_node_pair_t * j = current->data.mapping.pairs.start; j < current->data.mapping.pairs.top; ++j)
            {
                std::stringstream image_file;
                image_file << this->directory << "/" << yaml_document_get_node(&this->document, j->key)->data.scalar.value << ".bmp";

                SDL_Surface * tmp;
                if ((tmp = SDL_LoadBMP(image_file.str().c_str())) == NULL)
                    throw YamlSpriteParserError("Could not load image properly!");

                int pause;
                std::vector<int> rgb;

                yaml_node_t * interior = yaml_document_get_node(&this->document, j->value);
                if (current->type != YAML_MAPPING_NODE) throw YamlSpriteParserError("Improperly formatted configuration file!");
                for (yaml_node_pair_t * k = interior->data.mapping.pairs.start; k < interior->data.mapping.pairs.top; ++k)
                {
                    yaml_node_t * bottom = yaml_document_get_node(&this->document, k->value);
                    switch (bottom->type)
                    {
                        case YAML_SCALAR_NODE:
                            pause = lexical_cast<int>(bottom->data.scalar.value);
                            break;
                        case YAML_SEQUENCE_NODE:
                            for (yaml_node_item_t * transparency = bottom->data.sequence.items.start; transparency < bottom->data.sequence.items.top; ++transparency)
                                rgb.push_back(lexical_cast<int>(yaml_document_get_node(&this->document, *transparency)->data.scalar.value));
                            SDL_SetColorKey(tmp, SDL_SRCCOLORKEY, SDL_MapRGB(tmp->format, rgb[0], rgb[1], rgb[2]));
                            break;
                        default:
                            throw YamlSpriteParserError("Improperly formatted configuration file!");
                    }
                }

                this->frames.push_back(new Sprites::SpriteFrame(SDL_DisplayFormat(tmp), pause));
                SDL_FreeSurface(tmp);
            }
        }

        return this->frames;
    }

    YamlSpriteParserError::YamlSpriteParserError(const std::string & msg)
            : BaseError(msg)
    {
    }
}
