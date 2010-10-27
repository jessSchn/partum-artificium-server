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

module Xircd
  class XircdApplication
    
    def initialize
      self.parse_options
      self.parse_configuration(@options[:config])
    end

    def parse_options
      @options = Trollop::options do
        version "xircd 1.0.0 (c) 2010 Alex Brandt <alunduil@alunduil.com>"
        banner "usage: xircd [options]"

        opt :debug, "Output debugging information", :default => false, :short => "-d"
        opt :verbose, "Output verbose information", :default => false, :short => "-v"
        #opt :config, "Configuration file to use", :type => String, :short => "-c", 
        #  :default => "/etc/xircd/xircd.conf"
        opt :module, "Module directory to use", :type => String, :short => "-m",
          :default => "/etc/xircd/plugins.d"
      end

      #Trollop::die :config, "must exist" unless File.exists?(@options[:config])
      Trollop::die :module, "must exist" unless File.exists?(@options[:module])

      @options[:verbose] = @options[:debug] if @options[:debug]
    end

    def parse_configuration(file_path)
    end

    def run
      # Start a handler for every module in the module's directory.
      # Connect the SIGHUP handler to every process (including this one)
      #   so the processes reread configuration details appropriately.
      # Connect the SIGINT handler to kill children gracefully before
      #   dying.
      # Set an alarm at which to wake up and check on children.

      #puts Notices.verbose("Configuration File: " + @options[:config]) if @options[:verbose]
      puts Notices.verbose("Modules Directory: " + @options[:module]) if @options[:verbose]
      
      self.load_modules
    end

    def load_modules
      module_names = []
      @modules = []

      Dir.glob(File.join(@options[:module], "*")) { 
        |file| module_names << file.to_s.split('/')[-1] if File.directory?(file) 
      }
      
      $LOAD_PATH << @options[:module]
      require 'xircd_plugin'
      module_names.each { |x|
        XircdPlugin::XircdPluginFactory.load(File.join(@options[:module], x), @options[:debug], @options[:verbose]);
        $LOAD_PATH << File.join(@options[:module], x);
        @modules << XircdPlugin::XircdPluginFactory.create_bot(x, File.join(@options[:module], x, "conf", x + ".yaml"));
        $LOAD_PATH.delete_if { |i| i == File.join(@options[:module], x) }
      }

      @modules.delete_if { |x| x == nil } # Removing plugins that don't provide code.

      @modules.each { |x|
        puts Notices.debug("Loaded Module: " + x.class.to_s) if @options[:debug]
      }
    end
  end

  class XircdApplicationError < StandardError
  end
end

