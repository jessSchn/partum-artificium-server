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

require 'xircd_plugin'

class HelloWorldBot < XircdPlugin::XircdPlugin
  attr_accessor :handlers
end

class HelloWorldBotFactory < XircdPlugin::XircdPluginFactory
INFO=<<INFO
name: helloworld
author: Alex Brandt
description: A simple hello world plugin for xircd.
INFO

  def create(config)
    HelloWorldBot.new(config)
  end
end

