#!/usr/bin/ruby

############################################################################
#    Copyright (C) 2010 by Alex Brandt   #
#    alunduil@alunduil.com   #
#                                                                          #
#    This program is free software; you can redistribute it and#or modify  #
#    it under the terms of the GNU General Public License as published by  #
#    the Free Software Foundation; either version 2 of the License, or     #
#    (at your option) any later version.                                   #
#                                                                          #
#    This program is distributed in the hope that it will be useful,       #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of        #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         #
#    GNU General Public License for more details.                          #
#                                                                          #
#    You should have received a copy of the GNU General Public License     #
#    along with this program; if not, write to the                         #
#    Free Software Foundation, Inc.,                                       #
#    59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             #
############################################################################

require 'isaac/bot'

require 'yaml'
require 'find'

module XircdPlugin
  class XircdPluginFactory
    def get_info
      YAML.load(self.class::INFO)
    end

    def get_name
      get_info()['name']
    end

    def get_author
      get_info()['author']
    end

    def get_description
      get_info()['description']
    end

    def create
      nil
    end

    @@factories = []

    def self.inherited(p)
      @@factories << p
    end

    def self.factories
      @@factories
    end

    def self.create_bot(name, config)
      @@factories.each { |pfc|
        pf = pfc.new
        return pf.create(config) if pf.get_name == name
      }
      nil
    end

    def self.load(directory, debug, verbose)
      file = directory.split('/')[-1]
      Find.find(directory) do |entry|
        if File.file?(entry) and entry[/.+#{file}\.rb$/]
          puts Notices.debug("entry: " + entry) if debug
          puts Notices.debug("directory: " + entry) if debug
          require "#{entry}"
        end
      end
    end
  end

  class XircdPlugin
    def initialize(config)
      parse_config(config)
      @bots = {}
      @threads = {}
      connect
    end

    def run
      @bots.each { |name, bot|
        @threads[name] = @threads.new {
          bot.start
        }
      }
    end

    def connect
      @config.each_key { |name|
        @config[name]["servers"].each { |server|
          @bots[name] = Isaac::Bot.new
          @bots[name].configure do |c|
            c.nick = name
            c.server = server.split(/(:\/\/|:)/)[1]
            c.server = server.split(/(:\/\/|:)/)[2]
          end
        }
      }

      @bots.each { |name, bot|
        bot.on :connect do
          join @config[name]["channels"]
        end
      }
    end

    def parse_config(config)
      @config = YAML.load(File.open(config, "r") { |f| f.read })
    end
  end
end

