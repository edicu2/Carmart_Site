var express = require('express');
var router = express.Router();
module.exports = router;

var multer = require('multer');
var uploadSetting = multer({dest:"../uploads"});
router.post('http://www.carmarts.shop:3000/upload', uploadSetting.single('upload'), function(req,res) {
  var tmpPath = req.file.path;
  var fileName = req.file.filename;
  var newPath = "../public/images/" + fileName;
  fs.rename(tmpPath, newPath, function (err) {
    if (err) {
      console.log(err);
    }
    var html;
    html = "";
    html += "<script type='text/javascript'>";
    html += " var funcNum = " + req.query.CKEditorFuncNum + ";";
    html += " var url = \"/images/" + fileName + "\";";
    html += " var message = \"업로드 완료\";";
    html += " window.parent.CKEDITOR.tools.callFunction(funcNum, url);";
    html += "</script>";

    res.send(html);
  });

});
module.exports = router;
