add_executable(proteus main.cpp proteus.cpp proteusgame.cpp)
target_link_libraries(proteus SDL boost_program_options)
target_link_libraries(proteus errors sprite maps)
install_targets(/bin proteus)
