#include<iostream>
#include<cstdio>
#include<string>
#include<fstream>
#include<vector>
#include<algorithm>



using namespace std;


int main()
{
	string str,str1;
	fstream f;
	ofstream g;
	string temp;
	string query="INSERT INTO `stud`(`id`, `prn`, `pwd`, `fname`, `mname`, `lname`, `yr`, `bran`)VALUES ( '',";
	

	
	cout<<"Enter Name of File:\n";
	getline(cin,str);

	
	
	f.open(str);
	g.open("records.txt",std::ofstream::out);
	if(f.is_open())
	{	 
		int i=1;
		while(	f >>temp )
		{
			
			if(i<6)
		   {
				query = query + "'"+temp+"',";
				
				if(i==1)
					query = query + "'"+temp+"',";
				i++;
		   }
		   else 
		   {	i=1;
				query =query + "'"+temp+"'),\n('',";
		   }   
		   
		}
		g<<query;
		cout<<query;
		g.close();
		f.close();
		
	}
	else
	{
		cout<<"error in opening file try again or contact developer";
	}
	
	return 0;
}
