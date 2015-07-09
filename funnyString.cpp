// 	FunnyString
//    	"https://www.hackerrank.com/challenges/funny-string"
// 	"https://www.hackerrank.com/Hassancoeus"


#include <cmath>
#include <cstdio>
#include <iostream>
#include <algorithm>

using namespace std;

int main()
{
	int n=0;
	while(n<1 || n>10)
	{
		cin>>n;
	}
	
	string s[n];
	
	for(int i=0;i<n;i++)
	{
		cin>>s[i];
		while(s[i].length()<2 || s[i].length()>10000)
		{
			cin>>s[i];
		}
	}
	
	bool flag=true;
	int c=0;
	string str;

	for(int i=0;i<n;i++)
	{
		flag=true;
		c=s[i].length()-2;
		str=s[i];
		for(int j=1;j<s[i].length();j++)
		{
			if(abs(str[j]-str[j-1])!=abs(str[c]-str[c+1]))
			{
				flag=false;
				cout<<"Not Funny"<<endl;
				break;
			}
			c--;
		}
		if(flag==true)
		{
			cout<<"Funny"<<endl;
		}
	}
	return 0;
}
