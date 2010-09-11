add_subdirectory(yaml)
add_subdirectory(creature)
add_subdirectory(sprite)
add_subdirectory(map)

add_library(baseerrortest SHARED baseerrortest.cpp)
target_link_libraries(baseerrortest errors)
