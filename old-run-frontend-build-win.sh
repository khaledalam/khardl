# paths
$env:BUILD_PATH = 'temp'
$BACKEND_PUBLIC_PATH = 'backend/public'
$NEW_HASH_JS_MAIN_PATH = Join-Path -Path $BACKEND_PUBLIC_PATH -ChildPath 'static/js'
$NEW_HASH_CSS_MAIN_PATH = Join-Path -Path $BACKEND_PUBLIC_PATH -ChildPath 'static/css'
$INDEX_BLADE_FILE_PATH = 'backend/resources/views/index.blade.php'

# remove temp build folder
Remove-Item -Recurse -Force "frontend\$env:BUILD_PATH"

# build new fresh version of frontend
New-Item -ItemType Directory -Force -Path "frontend\$env:BUILD_PATH"
npm run build --prefix frontend

# remove old build static folder that contains old hashed files
Remove-Item -Recurse -Force "$BACKEND_PUBLIC_PATH\static"

# move new build frontend files
Copy-Item -Recurse -Force "frontend\$env:BUILD_PATH\" "$BACKEND_PUBLIC_PATH"

# remove temp build folder
Remove-Item -Recurse -Force "frontend\$env:BUILD_PATH"

# rename static filename hashes in index.blade.php
$NEW_JS_HASH = (Get-ChildItem -Path $NEW_HASH_JS_MAIN_PATH -File | Where-Object { $_.Name -match 'main[^/]*\.js$' }).BaseName -replace 'main\.(.*?)\.js', '$1'
$NEW_CSS_HASH = (Get-ChildItem -Path $NEW_HASH_CSS_MAIN_PATH -File | Where-Object { $_.Name -match 'main[^/]*\.css$' }).BaseName -replace 'main\.(.*?)\.css', '$1'

(Get-Content -Path $INDEX_BLADE_FILE_PATH) | ForEach-Object {
    $_ -replace "main\.([a-zA-Z0-9]*)\.css", "main.$NEW_CSS_HASH.css" `
       -replace "main\.([a-zA-Z0-9]*)\.js", "main.$NEW_JS_HASH.js"
} | Set-Content -Path $INDEX_BLADE_FILE_PATH
