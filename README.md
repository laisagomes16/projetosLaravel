Execute o passo a passo para executar o projeto

docker-compose build --no-cache = builda os containers\
docker compose up = sobe os containers\
docker exec -it projetos_laravel_app php artisan migrate = pra criar as migrations no container app\
docker exec -it projetos_laravel_app php artisan db:seed = pra criar dados ficticios\
Usuario criado
'name' => 'Test User',
'email' => 'test@example.com'

Para se autenticar com o google entre no console do google e gere um projeto com ativação de OAuth2 e troque o GOOGLE_CLIENT_ID  e GOOGLE_CLIENT_SECRET pelos dados reais.
Nao esqueça de criar um arquivo .env na raiz do projeto com os dados reais contidos no .env.example