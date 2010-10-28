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
require 'find'
require 'yaml'

module PovGen
  class PovGenApplication
    
    def initialize
      self.parse_options

      $stdout = File.new(@options[:output], 'w') if @options[:output] && @options[:output] != "-"
      @objects_dictionary = {}
    end

    def parse_options
      @options = Trollop::options do
        version "povgen 1.0.0 (c) 2010 Alex Brandt <alunduil@alunduil.com>"
        banner "usage: povgen [options]"

        opt :debug, "Output debugging information", :default => false, :short => "-D"
        opt :verbose, "Output verbose information", :default => false, :short => "-v"
        opt :camera, "Camera definition specified as <c1,c2,..,cn,f1,f2,..,fn>", :short => "-c", :type => String
        opt :directory, "YAML Configuration files directory", :short => "-d",
          :type => String
        opt :output, "Output file for the compiled file", :short => "-o",
          :type => String
      end

      Trollop::die :directory, "must exist" unless File.exists?(@options[:directory]) if @options[:directory]
      Trollop::die :output, "must exist" unless File.dirname(@options[:output]).exists?(@options[:output]) if @options[:output] != "-" if @options[:output]
      Trollop::die :camera, "one camera must be passed" unless @options[:camera]

      @options[:verbose] = @options[:debug] if @options[:debug]
    end

    def run
      output_camera
      load_directory
    end

    def output_camera
      puts "camera {"
      puts "  location " + camera_location
      puts "  look_at " + camera_look_at
      puts "}"
    end

    def camera_location
      ret = @options[:camera].split(',')[0, (@options[:camera].split(',').size/2).round].join(',')
      warn Notices.debug("Camera Location: " + ret) if @options[:debug]
      "<" + ret + ">"
    end

    def camera_look_at
      ret = @options[:camera].split(',')[(@options[:camera].split(',').size/2).round, @options[:camera].split(',').size].join(',')
      warn Notices.debug("Camera Location: " + ret) if @options[:debug]
      "<" + ret + ">"
    end

    def load_directory
      warn Notices.verbose("Loading YAML from " + @options[:directory]) if @options[:verbose]
      Find.find(@options[:directory]) do |entry|
        if File.file?(entry) and entry[/.+\.yml$/]
          warn Notices.verbose("loading " + entry) if @options[:verbose]
          dictionary = YAML.load(File.open(entry, 'r') { |f| f.read })
          @objects_dictionary.merge!(dictionary)
          warn Notices.debug("dictionary: " + dictionary.to_s) if @options[:debug]
          warn Notices.debug("@objects_dictionary: " + @objects_dictionary.to_s) if @options[:debug]
        end
      end
    end
  end

  class PovGenApplicationError < StandardError
  end
end

