IngestAI TestingMachine

1) Install Laravel

2) php artisan storage:link

3) php artisan queue:table

4) php artisan migrate

5) Set BEARER_TOKEN in the .env

6) Use the token from p.5 as the HTTP Header "X-Bearer-Token"


Install frontend
1) You should have installed node.js and npm on your local machine, please see documentation https://nodejs.org/
2) Stable version for node.js is 16.16.0 you can use this https://github.com/nvm-sh/nvm for installing several node versions in 1 machine
3) Go to project root directory and in your terminal run `npm i`
4) If you want build project in dev version you should run `npm run dev`, or `npm run build` for production version
5) For local version, follow the link you will find in terminal