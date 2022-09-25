var express = require('express');
var app = express();
var bodyParser = require('body-parser');
var mysql = require('mysql');

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
    extended: true
}));

// default route
app.get('/', function (req, res) {
    return res.send({ message: 'AMS-Node-Api is serving...' })
});

// connection configurations
var dbConn = mysql.createConnection({  //! change here
    host: 'localhost',
    user: 'ams-authenticator',
    password: 'amsauth000',
    database: 'james'
});

// connect to database
dbConn.connect();

function isEmpty(object) {
    return Object.keys(object).length === 0
}


// Add a new user  
app.post('/addattendance', function (req, res) {

    let student = req.body;

    if (isEmpty(student)) {
        return res.status(400).send({ response: 'Empty Request!' });
    }
    else if (student._uid == undefined || student._r_no == undefined||student._api_token==undefined) {
        return res.status(417).send({ response: 'Insufficient Request!' }); // parameter missing or invalid
    }
    else if (student._api_token !== "1008kbno9qessgzah1k5rjsnnwtr9yco2vlfgzw9nu5261"){
        return res.status(401).send({ response: 'Unauthorized Request!' });
    }
    else if (student._uid === "" || student._r_no === "") {
        return res.status(422).send({ response: 'Incomplete Request!' }); // value empty
    }
    else
    {
            dbConn.query('SELECT spid FROM Rfid_uid_spid_map WHERE uid=?;',student._uid, function (error, results) {

            if(error)
            {
                return res.send({ response: "Something went wrong!"});
            }
            else if(isEmpty(results))
            {
                return res.send({ response: "Uid not found!" });
            }
            else
            {   
                dbConn.query(`INSERT INTO Ams_api(reader_no,spid) values(${student._r_no},'${results[0].spid}');`, function (error){
                    if(error)
                    {
                        return res.send({ response: "Something went wrong!"});
                    }
                    else
                    {
                        return res.send({ response:1});
                    }
                 });
                
            }

        });
    
    }

});

// set port
let port = process.env.PORT || 3000 ;
app.listen(port, function () {
    console.log('Node app is running on port 3000');
});

module.exports = app;