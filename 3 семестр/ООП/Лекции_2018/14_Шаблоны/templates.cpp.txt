#include <bits/stdc++.h>
using namespace std;

template <typename T1, typename T2>
struct mPair{
	T1 first;
	T2 second;
//	bool operator < (mPair b){
//		return first!=b.first ? first<b.first : second<b.second;
//	}
};

template <typename T1, typename T2>
mPair<T1,T2> makePair(T1 first,T2 second){
	mPair<T1,T2> temp;
	temp.first=first;
	temp.second=second;
	return temp;
}

template <typename T>
void mSort(T *first, T * last){
	for(T * i=first; i!=last-1; ++i)
		for(T * j=i; j!=last-1; ++j)
			if(*j<*(j+1))
				swap(*j,*(j+1));
}

template <typename T>
void mSort(T *first, T * last, bool (*cmp) (T a, T b)){
	for(T * i=first; i!=last-1; ++i)
		for(T * j=i; j!=last-1; ++j)
			if(cmp(*j,*(j+1)))
				swap(*j,*(j+1));
}


bool cmp(mPair<int, int> a, mPair<int, int> b){
	return a.first!=b.first ? a.first<b.first : a.second<b.second;
}

template <typename T>
class mStack{
	protected:
		struct element{
			T x;
			element * next;
		} * head;
	public:
		mStack():head(NULL){}
		void push(T nx){
			element * temp = new element;
			temp->x = nx;
			temp->next = head;
			head = temp;
		}
		bool empty(){
			return !head;
		}
		void pop(){
			if(!empty()){
				element * temp = head;
				head = head->next;
				delete temp;
			}
		}
		T top(){
			return head->x;
		}
};


int main(){
	mStack<int> s;
	int n;
	cin>>n;
	for(int i=1; i<=n; ++i){
		s.push(i);
	}
	while(!s.empty()){
		cout<<s.top()<<" ";
		s.pop();
	}
}


