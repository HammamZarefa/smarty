import 'package:flutter/material.dart';


class NewsTabCard extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsetsDirectional.fromSTEB(0, 0, 0, 20),
      child: new Card(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(0),
          ),
          child: Column(
            children: [
              //title
              Container (
                padding:EdgeInsetsDirectional.fromSTEB(16, 16, 16, 0),
                width: MediaQuery.of(context).size.width*0.85,
                child:Row(
                  children: [
                    Text (
                      '01',
                      textAlign: TextAlign.start,
                      style: TextStyle(
                          fontSize: 20,
                        color:  Color(0xffF61067),
                      ),
                    ),
                    Text (
                      'The Title of the News',
                      textAlign: TextAlign.start,
                      style: TextStyle(
                          fontSize: 15
                      ),
                    ),
                  ],
                )
              ),
              //description
              Container (
                padding: const EdgeInsets.all(16.0),
                width: MediaQuery.of(context).size.width*0.85,
                child: Text (
                  'We\'re intersted in your ideas and would be glade to build something bigger out of it',
                  textAlign: TextAlign.start,
                  style: TextStyle(
                      fontSize: 10
                  ),
                ),
              ),

              //participants number
              Container (
                padding: EdgeInsetsDirectional.fromSTEB(16.0, 0, 16.0, 16.0),
                width: MediaQuery.of(context).size.width*0.85,
                child: Text (
                  '33 Participate',
                  textAlign: TextAlign.start,
                  style: TextStyle(
                      fontSize: 10
                  ),
                ),
              ),
              Divider(),
              Container(
                padding: EdgeInsetsDirectional.fromSTEB(16, 0, 0, 0),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.start,
                  children: [
                    //date
                    Row(
                      children: [
                        Icon(Icons.calendar_today,color: Color(0xffF61067),),
                        Text(
                          '30-6-2020',
                          style: TextStyle(
                              fontSize: 9
                          ),
                        ),
                      ],
                    ),

                  ],
                ),
              ),
              Divider(),

              Container(
                height: MediaQuery.of(context).size.width*0.5,
                width: MediaQuery.of(context).size.width*0.75,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  children: [
                    ClipRRect(
                      borderRadius: BorderRadius.circular(15),
                      child: Image(
                        image: AssetImage('assets/Bitmap (3).png'),
                        width:MediaQuery.of(context).size.width*0.35 ,
                        height: MediaQuery.of(context).size.width*0.4,

                      ),
                    ),
                    Column(
                      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                      children: [
                        ClipRRect(
                          borderRadius: BorderRadius.circular(13),
                          child: Image(
                            image: AssetImage('assets/Bitmap (1).png'),
                            width:MediaQuery.of(context).size.width*0.30 ,
                            height: MediaQuery.of(context).size.width*0.18,
                          ),
                        ),
                        ClipRRect(
                          borderRadius: BorderRadius.circular(13),
                          child:Image(
                            image: AssetImage('assets/Bitmap (2).png'),
                            width:MediaQuery.of(context).size.width*0.30 ,
                            height: MediaQuery.of(context).size.width*0.18,
                          ),
                        ),
                      ],
                    )
                  ],
                ),
              ),
            ],
          )
      ),
      decoration: new BoxDecoration(

        boxShadow: [
          new BoxShadow(
            color: Colors.black54,
            blurRadius: 10.0,
          ),
        ],
      ),
    );
  }
}