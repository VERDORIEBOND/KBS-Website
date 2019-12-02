@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../bombayworks/zendframework1/bin/zf.php
php "%BIN_TARGET%" %*
