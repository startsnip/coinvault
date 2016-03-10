<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>CIT 336 - SQL Joins</h1>
        <h4>Connecting tables since 1979</h4>
        <p>We often want to gather data which pertains to more that one table. To do this, we use the <code>JOIN</code> operator in an SQL statement.</p>
        <p>a <code>SQL JOIN</code> connects a table with another table based on the specified primary or foreign keys. As an example, we might want to combine a users table with an orders table when the CustomerID primary key in the users table matches the CustomerID foreign key in the Orders table.</p>
        <p>The first of the 4 <code>JOIN</code>s we will be discussing is the <code>INNER JOIN</code>.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2>INNER JOIN</h2>
        <img src="/images/img_innerjoin.gif" alt="Inner Join Venn Diagram">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-8">
        <p>An <code>INNER JOIN</code> is the most commonly used <code>JOIN</code>.</p>
        <p>An <code>INNER JOIN</code> will only return a row of data where there is at least one matching entry in <b>both</b> tables.</p>
        <h3>Example That Returns Data</h3>
        <ul>
          <li>Actress Sandra Bullock creates an account</li>
          <li>Actor Matthew Perry also creates an account</li>
          <li>An entry is created in the users table with a CustomerID of 223 to represent Sandra, and a CustomerID of 224 to represent Matthew</li>
          <li>Sandra creates an order</li>
          <li>An entry is created in the orders table with an OrderID of 42, and a CustomerID of 223</li>
          <li>Famous web developer Blaine Robertson then logs into the backend of his successful site</li>
          <li>Robertson clicks a link, which will direct him to a view and run an SQL query</li>
          <li>As this script uses an <code>INNER JOIN</code>, Robertson will see an entry for Sandra, but not for Matthew</li>
        </ul>
        <table>
          <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Customer ID</th>
          </tr>
          <tr>
            <td>...</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>42</td>
            <td>Sandra Bullock</td>
            <td>223</td>
          </tr>
        </table>
      </div>
      <div class="col-sm-4">
        <h3>Code</h3>
        <h4>Basic Structure</h4>
        <ol>
          <li><code>SELECT <i>table.column_name(s)</i></code></li>
          <li><code>FROM <i>table1</i></code></li>
          <li><code>INNER JOIN <i>table2</i></code></li>
          <li><code>ON <i>table1.column_name = table2.column_name;</i></code></li>
        </ol>
        <h4>Example SQL Query</h4>
        <ol>
          <li><code>SELECT Orders.OrderID, Customers.CustomerName, Customer.CustomerID</code></li>
          <li><code>FROM Customers</code></li>
          <li><code>INNER JOIN Orders</code></li>
          <li><code>ON Customers.CustomerID = Orders.CustomerID;</code></li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2>LEFT JOIN, RIGHT JOIN</h2>
        <img src="/images/img_leftjoin.gif" alt="Left JOIN Venn Diagram">
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <p>Each <code>JOIN</code> includes two tables. One before the JOIN clause, and one After.</p>
        <p>The table listed before the <code>JOIN</code> is considered the left table. The table listed after the <code>JOIN</code> is considered the right table.</p>
        <p>A <code>LEFT JOIN</code> will return a row of data for every entry in the left table, and will also return any matched data from the right table</p>
        <p>A <code>RIGHT JOIN</code> will return a row of data for every entry in the right table, and will also return any matched data from the left table</p>
        <h3>Example</h3>
        <ul>
          <li>Actress Sandra Bullock creates an account</li>
          <li>Actor Matthew Perry also creates an account</li>
          <li>An entry is created in the users table with a CustomerID of 223 to represent Sandra, and a CustomerID of 224 to represent Matthew</li>
          <li>Sandra creates an order</li>
          <li>An entry is created in the orders table with an OrderID of 42, and a CustomerID of 223</li>
          <li>Famous web developer Blaine Robertson then logs into the backend of his successful site</li>
          <li>Robertson clicks a link, which will direct him to a view and run an SQL query</li>
          <li>As this script uses a <code>LEFT JOIN</code>, Robertson will see
            an entry for both Sandra and Matthew. Matthews entry will display NULL for the OrderID</li>
        </ul>
        <table>
          <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Customer ID</th>
          </tr>
          <tr>
            <td>...</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>42</td>
            <td>Sandra Bullock</td>
            <td>223</td>
          </tr>
          <tr>
            <td>NULL</td>
            <td>Matthew Perry</td>
            <td>224</td>
          </tr>
        </table>
      </div>
      <div class="col-md-4">
        <h3>Code</h3>
        <h4>Basic Structure</h4>
        <ol>
          <li><code>SELECT <i>table.column_name(s)</i></code></li>
          <li><code>FROM <i>table1</i></code></li>
          <li><code>LEFT JOIN <i>table2</i></code></li>
          <li><code>ON <i>table1.column_name = table2.column_name;</i></code></li>
        </ol>
        <h4>Example SQL Query</h4>
        <ol>
          <li><code>SELECT Orders.OrderID, Customers.CustomerName, Customer.CustomerID</code></li>
          <li><code>FROM Customers</code></li>
          <li><code>LEFT JOIN Orders</code></li>
          <li><code>ON Customer.CustomerID = Orders.CustomerID;</code></li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h2>FULL OUTER JOIN</h2>
        <img src="/images/img_fulljoin.gif" alt="Full JOIN Venn Diagram">
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <p>A <code>FULL OUTER JOIN</code> will return all rows for both tables, and will combine data where there is a match.</p>
        <ul>
          <li>Actress Sandra Bullock creates an account</li>
          <li>Actor Matthew Perry also creates an account</li>
          <li>An entry is created in the users table with a CustomerID of 223 to represent Sandra, and a CustomerID of 224 to represent Matthew</li>
          <li>Sandra creates an order</li>
          <li>An entry is created in the orders table with an OrderID of 42, and a CustomerID of 223</li>
          <li>Famous web developer Blaine Robertson then logs into the backend of his successful site</li>
          <li>Robertson clicks a link, which will direct him to a view and run an SQL query</li>
          <li>As this script uses a <code>FULL OUTER JOIN</code>, Robertson will see
            an entry for both Sandra and Matthew. Matthews entry will display NULL for the OrderID.
            If there are orders which are not associated with a user, Robertson will
            also see these orders listed in his query</li>
        </ul>
        <table class="bordered">
          <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Customer ID</th>
          </tr>
          <tr>
            <td>1</td>
            <td>NULL</td>
            <td>NULL</td>
          </tr>
          <tr>
            <td>2</td>
            <td>NULL</td>
            <td>NULL</td>
          </tr>
          <tr>
            <td>...</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>42</td>
            <td>Sandra Bullock</td>
            <td>223</td>
          </tr>
          <tr>
            <td>NULL</td>
            <td>Matthew Perry</td>
            <td>224</td>
          </tr>
        </table>
      </div>
      <div class="col-md-4">
        <h3>Code</h3>
        <h4>Basic Structure</h4>
        <ol>
          <li><code>SELECT <i>table.column_name(s)</i></code></li>
          <li><code>FROM <i>table1</i></code></li>
          <li><code>FULL OUTER JOIN <i>table2</i></code></li>
          <li><code>ON <i>table1.column_name = table2.column_name;</i></code></li>
        </ol>
        <h4>Example SQL Query</h4>
        <ol>
          <li><code>SELECT Orders.OrderID, Customers.CustomerName, Customer.CustomerID</code></li>
          <li><code>FROM Customers</code></li>
          <li><code>FULL OUTER JOIN Orders</code></li>
          <li><code>ON Customer.CustomerID = Orders.CustomerID;</code></li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p>Venn Diagram Images curtesy of <a href="http://www.w3schools.com/sql/sql_join.asp" title="W3Schools">W3Schools</a></p>
        <p>Practice examples avaliable at <a href="http://www.w3schools.com/sql/sql_join.asp" title="W3Schools">W3Schools</a></p>
      </div>
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
  </body>
</html>