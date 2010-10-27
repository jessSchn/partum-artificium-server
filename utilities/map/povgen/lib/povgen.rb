#!/usr/bin/ruby

############################################################################
#    Copyright (C) 2010 by Alex Brandt <alunduil@alunduil.com>             #
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

require 'trollop'

module PovGen
  class PovGenApplication
    
    def initialize
      self.parse_options
    end

    def parse_options
      @options = Trollop::options do
        version "povgen 1.0.0 (c) 2010 Alex Brandt <alunduil@alunduil.com>"
        banner "usage: povgen [options]"

        opt :debug, "Output debugging information", :default => false, :short => "-d"
        opt :verbose, "Output verbose information", :default => false, :short => "-v"
      end

      @options[:verbose] = @options[:debug] if @options[:debug]
    end

    def run
    end
  end

  class XircdApplicationError < StandardError
  end
end
