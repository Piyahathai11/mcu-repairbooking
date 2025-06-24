<div className="col-lg-10 col-md-8 ">
    <div className="container mt-5 ">
      <div className="card  p-4">
        <h2 className="mb-4">อัปเดตเพิ่มเติม</h2>
        {error && <div className="alert alert-danger">{error}</div>}
        <form onSubmit={handleSubmit}>
          <div className="form-group mb-3">
            <label>วันที่เสร็จ/คาดว่าจะเสร็จ</label>
            <input
              type="date"
              className="form-control"
              value={finishedDate}
            />
          </div>
          <div className="form-group mb-3">
            <label>เพิ่มเติม</label>
            <textarea
              className="form-control"
              rows={3}
              value={updateNote}
            ></textarea>
          </div>
          <div className="form-group mb-3">
            <label>ค่าใช้จ่าย</label>
            <input
              type="number"
              className="form-control"
              value={totalPayment}
            />
          </div>
          <button type="submit" className="btn btn-success">
           บันทึก
          </button>
        </form>
      </div>
    </div>
  </div>