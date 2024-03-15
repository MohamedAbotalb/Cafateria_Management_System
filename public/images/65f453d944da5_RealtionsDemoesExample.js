// Task :  students Names and Their Departments


// connect only once departments show collections
let departments=db.departments.find({},{name:1}).toArray();

db.students.find({},{firstName:1,lastName:1,department:1})
            .forEach(doc=>{
                // let department_name=    db.departments.findOne({_id:doc.department},{name:1}).name
                let department_name= departments.find(department=>department._id==doc.department ).name
                print(`${doc.firstName} : ${department_name}`);
            })