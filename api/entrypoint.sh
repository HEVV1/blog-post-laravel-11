echo "Waiting for database to be ready..."
until nc -z db 3306; do
  sleep 1
done

echo "Running migrations..."
php artisan migrate --force
