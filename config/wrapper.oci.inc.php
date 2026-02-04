<?php

#-----------

# Wrapper of mysql_connect()

#-----------

function connectDB($server,$usr,$pass)
{

	return oci_connect($user,$pass,$server) or die("Not connect with oracle");
	//return mysql_connect($server,$usr,$pass);

}

#-----------

# Wrapper of mysql_select_db()

#-----------

function selectDB($db,$con)
{
	return mysql_select_db($db,$con);
}

#-----------

# Wrapper of mysql_query()

#-----------

function execQuery($query,$con)
{
	$query_parse = oci_parse($con, $query);
	return oci_execute($query_parse);
}

#-----------

# Wrapper of mysql_error()

#-----------

function sqlError()
{
	return mysql_error();
}

#-----------

# Wrapper of mysql_fetch_array()

#-----------

function fetchRecord($rs)

{
	return oci_fetch($rs);
	//return mysql_fetch_array($rs);

}

#-----------

# Wrapper of mysql_fetch_assoc()

#-----------

function fetchAssoc($rs)

{

	return mysql_fetch_assoc($rs);

}

#-----------

# Wrapper of mysql_num_rows()

#-----------

function countRowNums($rs)

{

	return mysql_num_rows($rs);

}

#-----------

# Wrapper of mysql_insert_id()

#-----------

function getInsertID()

{

	return mysql_insert_id();

}





?>