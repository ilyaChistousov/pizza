## Installation
### 1) Backend
1) Copy .env.example
```
cp .env.example .env
```
2) Add db host user password to .env

3) Run docker services
```
docker-compose up --env-file ./backend/.env -d --build
```
4) Install dependencies
```
docker-compose exec app composer install
```
5) Create token
```
docker-compose exec app key:generate
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