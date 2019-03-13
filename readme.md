# Projeto para disponibilizar uma API para consulta a partir de um arquivo JSON no diretório /data
# Lumen Framework Laravel
 ## Instalaçao

Clonar o projeto.
<pre>
    <code>
        git clone git@github.com:msartini/lumen.git {pasta do projeto}
    </code>
</pre>

Vá para a pasta do projeto.
<pre>
    <code>
        cd {pasta do projeto}
    </code>
</pre>

Execute o composer install.
<pre>
    <code>
        Ex. composer install
    </code>
</pre>

Suba o servidor http.
<pre>
    <code>
        php -S localhost:8000 -t public
    </code>
</pre>

###As pesquisas são relizadas com OR e não AND
Acesso dos dados na homepage
<p>Ex.: Consultar cidade Araquari, sem ordenação, para escolher outros filtros, informe nos respectivos campos.</p>
<pre>
    <code>
        http://localhost:8000/?q=&cidade=Araquari&sort_salary=
    </code>
</pre>

Acesso dos dados pela Api.
<p>Ex.: Para onsultar a vaga com a palavra Analista ou na cidade de Bento Gonçalves e ordenação do maior para o menor salário.</p>
<pre>
    <code>
        http://localhost:8000/api/?q=Analista&cidade=Bento+Goncalves&sort_salary=desc
    </code>
</pre>





