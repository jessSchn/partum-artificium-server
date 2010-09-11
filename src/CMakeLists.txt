add_executable(partum-artificium main.cpp partumartificium.cpp)
target_link_libraries(partum-artificium SDL boost_program_options)
install_targets(/usr/bin partum-artificium)
