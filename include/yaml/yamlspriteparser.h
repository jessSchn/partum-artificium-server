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

#ifndef YAMLSPRITEPARSER_H
#define YAMLSPRITEPARSER_H

#include <vector>
#include <string>
#include <yaml.h>
#include <cstdio>

#include "../../include/sprite/spriteframe.h"
#include "../../include/baseerror.h"

namespace Yaml
{
    class YamlSpriteParser
    {
        public:
            /**
             * @brief Constructor.
             * @param file The file to parse.
             * @param debug Whether or not to debug.
             * @param verbose Whether or not to be verbose.
             */
            YamlSpriteParser(const std::string & file, bool debug = false, bool verbose = false);

            /**
             * @brief Destructor.
             */
            ~YamlSpriteParser();

            /**
             * @brief Parse the file.
             * @return A list of frames we collected from the file.
             */
            std::vector<Sprites::SpriteFrame *> Parse();

        private:
            /**
             * @brief Get a token from the YAML tokenizer.
             * @return A token of type yaml_token_t.
             */
            yaml_token_t getToken();

            /**
             * @brief Parse the stream production.
             * @note stream ::= STREAM-START document* STREAM-END
             */
            void parseStream();

            /**
             * @brief Parse the document production.
             * @note document ::= DOCUMENT-START node DOCUMENT-END
             */
            void parseDocument();

            std::string directory;
            yaml_document_t document;
            yaml_parser_t parser;
            std::vector<Sprites::SpriteFrame *> frames;

            FILE * config_fd;

            bool debug;
            bool verbose;
    };

    class YamlSpriteParserError : public Errors::BaseError
    {
        public:
            YamlSpriteParserError(const std::string & msg);
    };
}

#endif // YAMLPARSER_H
