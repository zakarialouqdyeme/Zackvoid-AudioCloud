$(document).ready(async () => {

    var path = window.location.pathname;
    var page = path.split("/").pop();
    if (page == "profs.php") $("#navProfs").addClass("active");
    if (page == "schools.php") $("#navSchools").addClass("active");
    if (page == "statistique.php") $("#navStat").addClass("active");
    if (page == "students.php") $("#navStudents").addClass("active");
    if (page == "classes.php") $("#navClasses").addClass("active");
    if (page == "correction.php") $("#navCorrection").addClass("active");
});