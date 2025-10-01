#!/bin/bash

# Start Laravel server accessible from network
echo "Starting Laravel server on http://worker:8000 (also accessible via IP)"
php artisan serve --host=0.0.0.0 --port=8000 &

# Give Laravel a moment to start
sleep 2

# Start Vite dev server
echo "Starting Vite development server..."
npm run dev

# When script is terminated, kill the Laravel server
trap "kill $!" EXIT