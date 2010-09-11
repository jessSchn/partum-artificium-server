include_directories(${CMAKE_CURRENT_SOURCE_DIR}/include)
link_directories(${CMAKE_CURRENT_BINARY_DIR}/lib)

add_subdirectory(lib)

# Define the absolute path to the unit tests so we load them properly.
add_definitions(-DTEST_PATH="${CMAKE_CURRENT_BINARY_DIR}/lib")

add_executable(test_proteus main.cpp)
target_link_libraries(test_proteus cppunit boost_filesystem)
target_link_libraries(test_proteus creaturetest)

add_test(UnitTests ${CMAKE_CURRENT_BINARY_DIR}/test_proteus compiler)
