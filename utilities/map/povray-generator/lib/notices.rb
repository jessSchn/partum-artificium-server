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

module Notices
  private

  def self.colorize(text, color_code)
    "#{color_code}#{text}\e[0m"
  end

  def self.get_columns
    `stty size`.split.map { |x| x.to_i }.reverse[0]
  end

  def self.get_spaces(msg)
    " "*(self.get_columns - (msg.length + 6))
  end

  def self.bracketize(text)
    "[ " + text + " ]"
  end

  def self.print(msg, code, colorf)
    self.send(colorf, msg) + self.get_spaces(msg) + 
      self.bracketize(self.send(colorf, self.send(code)))
  end    

  public

  def self.black(str); self.colorize(str, "\e[30m"); end
  def self.red(str); self.colorize(str, "\e[31m"); end
  def self.green(str); self.colorize(str, "\e[32m"); end
  def self.yellow(str); self.colorize(str, "\e[33m"); end
  def self.light_blue(str); self.colorize(str, "\e[01;34m"); end
  def self.blue(str); self.colorize(str, "\e[34m"); end
  def self.magenta(str); self.colorize(str, "\e[35m"); end
  def self.cyan(str); self.colorize(str, "\e[36m"); end
  def self.white(str); self.colorize(str, "\e[37m"); end

  def self.ERROR; "!!"; end
  def self.WARNING; "WW"; end
  def self.VERBOSE; "VV"; end
  def self.DEBUG; "DD"; end
  def self.SUCCESS; "OK"; end

  def self.error(msg); self.print(msg, :ERROR, :red); end
  def self.warning(msg); self.print(msg, :WARNING, :yellow); end
  def self.verbose(msg); self.print(msg, :VERBOSE, :light_blue); end
  def self.debug(msg); self.print(msg, :DEBUG, :magenta); end
  def self.success(msg); self.print(msg, :SUCCESS, :green); end
end

