#README 
<h1>getDatadb</h1>
<lang='en-us'></lang>
<h2>English description</h2>
<h3>This is a simple form to work for databases</h3>
<h4>I use composer for this code, if you not use a composer, 
clone this project and include in your pages.</h4>
<lang='pt-br'></lang>
<h2>Português Brasil</h2>
<h3>Uma forma simples de trabalhar com banco de dados</h3>
<h4>Estou usando composer para esse projeto, se não quiserr ou puder usar, clone esse repositorio, e inclua manualmente as paginas das classes que for usar.</h4>

<h2>Functions | Funções</h2>
<ul>
    <h2>
    getCTimestamp()
    </h2>
    <li>
    <h2>Example | Exemplo</h2>
    </li>
    <li><pre><h2>
    $obj = new getDatadb;
    $obj->conn =(object)[
        'username'=>'user name database',
        'servername'=>'localhost',
        'password'=>'password for your db',
        'database'=>'name of your database'
        ];
    $obj->getCTimestamp(); //retun a database current_timestamp
    </h2>
    </pre>
    </li>
    <li><h3> Get a current_timestamp to dataserver. </h3></li>
    <li><h3>Executa uma busca pelo current_timestamp no servidor do banco de dados.</h3></li>
<ul>