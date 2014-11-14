## twenty_object

### GET
#### Parameters
* id
* name
* random (=1)
* limit
* offset
#### Return object (in this case is one object, the return can be also array)
```
{
    "id": "1",
    "name": "test",
    "image_url": "asdfdsfdsf"
}
```
### POST
#### Parameters
#### Return object
### PUT
### DELETE

## twenty_record

### GET
#### Parameters
* user_id
* object_id
* random (=1)
* limit
* offset
#### Return object (in this case is one object, the return can be also array)
```
[
    {
        "id": "11",
        "user_id": "1",
        "object_id": "2",
        "duration": "0",
        "timestamp": "2014-11-04 09:41:42",
        "first_name": "Super",
        "last_name": "Admin",
        "name": "dfsdf",
        "image_url": "http://www.wigglestatic.com/images/tdf-col-du-tourmalet-tshirt-11-zoom.jpg",
        "ideas": [
            {
                "id": "5",
                "content": "to eat"
            },
            {
                "id": "6",
                "content": "To feed animal"
            }
        ]
    }
]
```
### POST
#### Parameters
* user_id
* object_id
* content (a JSON string contain array of records)
```
[
  {
    "text": "to eat"
  },
  {
    "text": "To feed animal"
  }
]
```
#### Return object
```
{
    "success": "Content added"
}
```
### PUT
### DELETE
