<div>

# dbConnect

### Class Definition (DBConnect):

#### The class has private properties ($server, $dbname, $user, $pass) that store the database connection details.

### connect Method:

#### The connect method attempts to create a new PDO object, representing a connection to the database.

#### It uses the connection details stored in the class properties ($server, $dbname, $user, $pass).

#### If the connection is successful, it sets the PDO attribute PDO::ATTR_ERRMODE to PDO::ERRMODE_EXCEPTION. This configuration enables PDO to throw exceptions for errors.

#### The method then returns the PDO connection object.

# .htaccess

## "cross origin "multiple domain" request"

#### RewriteCond %{REQUEST_FILENAME} !-f: This line is another RewriteCond that checks if the requested URL does not point to a file (!-f means "not a file"). If both this condition and the previous one are true, it proceeds to the next step.

#### RewriteRule ^ index.php [L]: This is the RewriteRule that gets executed if both conditions are true. It essentially redirects the request to index.php. The ^ in the pattern means that it should match the beginning of the URL. The [L] flag indicates that this is the last rule to be processed if it matches.

#### In summary, this set of rules is commonly used to redirect all requests that do not match an existing file or directory to the index.php file. This is a common practice in many PHP web applications where the index.php file serves as the entry point and handles routing and processing for the entire application. The front controller pattern helps centralize the handling of requests, making it easier to manage and maintain the application's structure.

##### code was copied from "https://github.com/laravel/lumen/blob/10.x/public/.htaccess"

<br />
<br />
<br />

# index.php

## Error handling

#### error_reporting(E_ALL);: This line sets the level of error reporting for your PHP script. It specifies which types of errors should be reported. In this case, E_ALL is used, which includes all error levels - notices, warnings, errors, and strict standards. This setting ensures that all possible errors will be reported.

#### ini_set('display_errors', 1);: This line uses the ini_set function to dynamically change the configuration setting 'display_errors'. The value 1 indicates that errors should be displayed on the screen when they occur. This is particularly useful during development and debugging, as it provides immediate feedback on any issues in your code.

## Cross-Origin Resource Sharing (CORS)

#### header('Access-Control-Allow-Origin: _');: This header indicates which origins are allowed to access the resources of the web server. In this case, the asterisk _ as the value means that any origin is allowed. This is a common setting when you want to allow cross-origin requests from any domain.

#### header('Access-Control-Allow-Headers: _');: This header specifies which HTTP headers can be used when making the actual request to the server. By using _ as the value, you are allowing any headers to be sent in the request.

#### These headers are often used to enable cross-origin requests in web applications. For security reasons, browsers typically block requests that come from a different origin than the one that served the web page. CORS headers like the ones you've included tell the browser to allow requests from any origin and with any headers.

##### It's worth noting that using \* for Access-Control-Allow-Headers may be overly permissive, and in a production environment, you might want to specify only the headers that your application actually needs. This is done to enhance security and reduce the risk of potential vulnerabilities.

##### Always be cautious when using the wildcard (\*) in CORS headers, especially in a production environment, and make sure it aligns with your security requirements.

<br/>

## Datebase Connect

#### include 'DBConnect.php';: This line includes the contents of the file named DBConnect.php into the current PHP script. The file likely contains a class or functions related to database connectivity.

#### $objDb = new DBConnect();: This line creates a new instance of the DBConnect class. In object-oriented programming (OOP), creating an instance of a class is also known as instantiation. This line is essentially creating an object, denoted by $objDb, based on the DBConnect class.

#### $conn = $objDb->connect();: This line calls a method named connect on the $objDb object. Presumably, the DBConnect class has a method named connect that establishes a connection to the database. The result of this method call is stored in the variable $conn. This variable is likely to hold a database connection object or a reference to the connection.

#### var_dump($conn);: This line uses the var_dump function to display information about the variable $conn. In this context, it is likely used for debugging purposes to inspect the structure and properties of the $conn variable. This can help you verify that the database connection was successfully established and to see any details about the connection object.

#### $user = json_decode(file_get_contents('php://input'));: This line reads the raw input data from the request body using file_get_contents('php://input'). This data is assumed to be in JSON format, and json_decode is used to convert it into a PHP object. The resulting object is stored in the $user variable.

#### $method = $\_SERVER['REQUEST_METHOD'];: This line retrieves the HTTP request method (e.g., GET, POST, PUT, DELETE) from the $\_SERVER superglobal. The method is then stored in the $method variable.

## Switch Statment

#### switch($method) {: This initiates a switch statement based on the HTTP request method.

#### case 'POST':: This is a case within the switch statement, specifically checking if the request method is POST.

#### $sql = "INSERT INTO users(id, name, email, mobile, created_at) VALUES(null, :name, :email, :mobile, :created_at)";: This line defines an SQL query for inserting data into a table named users. It uses placeholders (:name, :email, :mobile, :created_at) for values that will be bound later.

#### $stmt = $conn->prepare($sql);: This prepares the SQL statement for execution using the database connection stored in the $conn variable.

#### $created_at = date('Y-m-d');: This line gets the current date in the format 'Y-m-d' and stores it in the $created_at variable.

#### $stmt->bindParam(':name', $user->name);: This binds the value of $user->name to the :name placeholder in the prepared statement.

#### Similar binding statements follow for :email, :mobile, and :created_at.

#### if ($stmt->execute()) {: This checks if the execution of the prepared statement is successful.

#### If the execution is successful, it sets $response with a success message; otherwise, it sets $response with an error message.

#### echo json_encode($response);: This line converts the $response array to JSON format and echoes it back as the response to the client.

</div>
