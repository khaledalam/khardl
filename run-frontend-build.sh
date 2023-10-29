#!/bin/bash

# paths
export BUILD_PATH='temp'
BACKEND_PUBLIC_PATH='backend/public'

NEW_HASH_JS_MAIN_PATH="$BACKEND_PUBLIC_PATH/static/js"
INDEX_BLADE_FILE_PATH='backend/resources/views/index.blade.php'


# remove temp build folder
rm -rf frontend/$BUILD_PATH


# build new fresh version of frontend
mkdir -p frontend/$BUILD_PATH
npm run build --prefix frontend


# remove old build static folder that contains old hashed files
rm -rf $BACKEND_PUBLIC_PATH/static


# move new build frontend files
cp -r frontend/$BUILD_PATH/ $BACKEND_PUBLIC_PATH/

# remove temp build folder
rm -rf frontend/$BUILD_PATH

# rename static filename hashes in index.blade.php
#NEW_HASH=$(find "$NEW_HASH_JS_MAIN_PATH" -type f -regex ".*/main[^/]*\.js$")
#
#sed -i "s/main\.\([a-zA-Z0-9]*\)\.css/$NEW_HASH/g" "$INDEX_BLADE_FILE_PATH"
#sed -i "s/main\.\([a-zA-Z0-9]*\)\.js/$NEW_HASH/g" "$INDEX_BLADE_FILE_PATH"

