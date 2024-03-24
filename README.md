## Installation
### 1) Backend
1) Go to backend folder
```
cd backend
```
2) Copy .env.example
```
cp .env.example .env
```
3) Run docker services
```
docker-compose up -d --build
```
4) Install dependencies
```
docker-compose exec backend composer install
```
5) Create token
```
docker-compose exec backend php artisan key:generate
```

### 2) Frontend

1) Go to frontend folder
```
cd frontend
```
2) Install dependencies
```
npm install
```
3) Run
```
npm run dev
```