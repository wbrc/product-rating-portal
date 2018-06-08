#!/bin/sh
docker run -p 2222:22 -p 8080:80 -d -v $(pwd):/www 4de7ee9caea5 > id.dock
